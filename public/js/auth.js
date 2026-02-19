
/* ---------------- PASSWORD TOGGLE ---------------- */

document.querySelectorAll('.toggle-password').forEach(toggle => {
    toggle.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});



document.addEventListener('DOMContentLoaded', () => {

    /* ================= ELEMENTS ================= */
    const form = document.getElementById('registrationForm');
    const existingMsg = document.getElementById('existingAccountMessage');

    const fields = {
        email: {
            input: document.getElementById('registerEmail'),
            validate: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
            message: 'Please enter a valid email address.'
        },
        phone: {
            input: document.getElementById('registerPhone'),
            validate: v => {
                const c = v.replace(/[^\d+]/g, '');
                return [
                    /^01[3-9]\d{8}$/,
                    /^8801[3-9]\d{8}$/,
                    /^\+8801[3-9]\d{8}$/
                ].some(p => p.test(c));
            },
            message: 'Enter a valid Bangladeshi mobile number.'
        },
        photo_id_number: {
            input: document.getElementById('photoIdNumber'),
            validate: v => v.trim().length >= 4,
            message: 'Photo ID number is too short.'
        }
    };

    const password = document.getElementById('registerPassword');
    const confirmPassword = document.getElementById('registerConfirmPassword');

    /* ================= STATE ================= */
    const duplicateStatus = {
        email: false,
        phone: false,
        photo_id_number: false
    };

    const lastChecked = {
        email: '',
        phone: '',
        photo_id_number: ''
    };

    /* ================= HELPERS ================= */
    function showError(input, msg) {
        input.classList.add('is-invalid');
        const fb = document.getElementById(input.getAttribute('aria-describedby'));
        if (fb) fb.textContent = msg;
    }

    function clearError(input) {
        input.classList.remove('is-invalid');
        const fb = document.getElementById(input.getAttribute('aria-describedby'));
        if (fb) fb.textContent = '';
    }

    function updateExistingMsg() {
        existingMsg.style.display =
            Object.values(duplicateStatus).some(Boolean) ? 'block' : 'none';
    }

    function debounce(fn, delay = 500) {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...args), delay);
        };
    }

    /* ================= UNIQUE CHECK ================= */
    const checkUnique = debounce((key, value) => {
        if (!value || lastChecked[key] === value) return;

        lastChecked[key] = value;

        fetch('/check-unique-field', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ field: key, value })
        })
            .then(r => r.json())
            .then(({ exists }) => {
                duplicateStatus[key] = exists;

                if (exists) {
                    showError(fields[key].input,
                        `This ${key.replace('_', ' ')} is already registered.`);
                }

                updateExistingMsg();
            });
    });

    /* ================= FIELD EVENTS ================= */
    Object.entries(fields).forEach(([key, cfg]) => {
        const input = cfg.input;

        // typing → clear format + duplicate error
        input.addEventListener('input', () => {
            clearError(input);

            if (duplicateStatus[key]) {
                duplicateStatus[key] = false;
                updateExistingMsg();
            }
        });

        // blur → validate → unique check
        input.addEventListener('blur', () => {
            if (!cfg.validate(input.value)) {
                showError(input, cfg.message);
                return;
            }
            checkUnique(key, input.value.trim());
        });
    });

    /* ================= PASSWORD ================= */
    password.addEventListener('blur', () => {
        if (!/^(?=.*[A-Za-z])(?=.*\d).{4,}$/.test(password.value)) {
            showError(password, 'Password must contain letters and numbers (min 4).');
        } else clearError(password);
    });

    confirmPassword.addEventListener('blur', () => {
        if (password.value !== confirmPassword.value) {
            showError(confirmPassword, 'Passwords do not match.');
        } else clearError(confirmPassword);
    });

    /* ================= SUBMIT ================= */
    form.addEventListener('submit', e => {
        if (submitting) {
            e.preventDefault();
            return;
        }

        submitting = true;
        if (
            document.querySelector('.is-invalid') ||
            Object.values(duplicateStatus).some(Boolean)
        ) {
            e.preventDefault();
            document.querySelector('.is-invalid')?.focus();
        }
    });


    // window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;


    // SEND OTP
    if (sendOtpBtn) {
        sendOtpBtn.addEventListener('click', function () {
            if (sendOtpBtn.disabled) return; // guard

            sendOtpBtn.disabled = true;
            sendOtpBtn.innerText = 'Sending...';
            sendOtp();
        });
    }

    // VERIFY OTP
    if (verifyOtpBtn) {
        verifyOtpBtn.addEventListener('click', function () {
            fetch('/otp/verify', {
                method: 'POST',
                credentials: 'same-origin', // ⭐ REQUIRED
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: phoneInput.value,
                    otp_code: otpInput.value
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        otpSuccessMsg.style.display = 'block';
                        finalRegisterBtn.disabled = false;
                        finalRegisterBtn.style.display = 'block';
                        verifyOtpBtn.disabled = true;
                        otpSuccessMsg.innerText = '✅ PHONE VERIFIED';
                        otpSuccessMsg.style.display = 'flex';
                        phoneInput.readOnly = true;
                        otpInput.readOnly = true;
                        verifyOtpBtn.style.display = 'none';
                        sendOtpBtn.style.display = 'none';
                        resendOtpBtn.style.display = 'none';
                    } else {
                        sendOtpBtn.disabled = false;
                        sendOtpBtn.innerText = 'Send OTP';
                        alert(data.message || 'Invalid OTP');
                    }
                });
        });
    }

    // RESEND OTP
    if (resendOtpBtn) {
        resendOtpBtn.addEventListener('click', function () {
            console.log('Resending OTP...');
            // sendOtpBtn.click();
            sendOtp(); // Restart 60 seconds timer for resend
        });
    }

});


/* ---------------- OTP SEND/VERIFY ---------------- */
const sendOtpBtn = document.getElementById('sendOtpBtn');
const verifyOtpBtn = document.getElementById('verifyOtpBtn');
const resendOtpBtn = document.getElementById('resendOtpBtn');
const otpSection = document.getElementById('otpSection');
const finalRegisterBtn = document.getElementById('finalRegisterBtn');

const phoneInput = document.getElementById('registerPhone');
const otpInput = document.getElementById('otp');
const otpSuccessMsg = document.getElementById('otpSuccessMsg');

const csrfMeta = document.querySelector('meta[name="csrf-token"]');
const csrf = csrfMeta ? csrfMeta.content : '';

function sendOtp() {
    fetch('/otp/send', {
        method: 'POST',
        credentials: 'same-origin', // 🔑 REQUIRED
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            phone: phoneInput.value
        })
        /* headers: {
            'Content-Type': 'application/json',
            // 'X-CSRF-TOKEN': csrf
            'X-CSRF-TOKEN': window.csrfToken
        }, */
        /*  body: JSON.stringify({
            phone: phoneInput.value
         }) */
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                otpSection.style.display = 'block';
                sendOtpBtn.disabled = true;
                sendOtpBtn.innerText = 'OTP Sent';
                startResendTimer(300); // Start 60 seconds timer for resend  
            } else {
                alert(data.message || 'Failed to send OTP');
            }
        })
        .catch(() => alert('Something went wrong'));
}

/* ---------------- RESEND TIMER ---------------- */
let resendTimer = null;

function startResendTimer(seconds = 300) {
    const timerWrapper = document.getElementById('timerResendBtn');
    const counter = document.getElementById('resendCounter');
    const resendBtn = document.getElementById('resendOtpBtn');

    // Reset UI
    resendBtn.style.display = 'none';
    timerWrapper.style.display = 'block';

    let remaining = seconds;
    counter.textContent = remaining;

    clearInterval(resendTimer);

    resendTimer = setInterval(() => {
        remaining--;
        counter.textContent = remaining;

        if (remaining <= 0) {
            clearInterval(resendTimer);
            timerWrapper.style.display = 'none';
            sendOtpBtn.style.display = 'none';
            resendBtn.style.display = 'block';
        }
    }, 1000);
}