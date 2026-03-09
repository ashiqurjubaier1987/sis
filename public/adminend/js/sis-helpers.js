'use strict';

/**
 * SIS Global Helpers
 * Reusable utilities for all modules: form protection, alerts, confirmations.
 */
var SIS = (function ($) {

    /**
     * Form multi-submit guard.
     * Disables submit buttons and shows a loading spinner on the clicked button.
     * Works with any form — just call SIS.formGuard('#myForm').
     */
    function formGuard(formSelector) {
        $(formSelector).on('submit', function () {
            var $form = $(this);

            // Prevent double submission
            if ($form.data('sis-submitting')) {
                return false;
            }
            $form.data('sis-submitting', true);

            // Disable all submit buttons in the form
            var $buttons = $form.find('[type="submit"]');
            $buttons.prop('disabled', true);

            // Show loading state on the clicked button
            var $clicked = $(document.activeElement);
            if ($clicked.is('[type="submit"]') && $clicked.closest(formSelector).length) {
                $clicked.data('sis-original-html', $clicked.html());
                $clicked.html('<i class="feather icon-loader spin m-r-5"></i> Saving...');
            }
        });
    }

    /**
     * Show SweetAlert success modal if a flash message exists.
     * Reads the message from a hidden element: #sis-flash-success
     * Place this in your Blade: <div id="sis-flash-success" data-message="{{ session('success') }}"></div>
     */
    function showFlash() {
        var $el = $('#sis-flash-success');
        if ($el.length && $el.data('message')) {
            swal("Success!", $el.data('message'), "success");
            $el.removeAttr('data-message');
        }
    }

    /**
     * SweetAlert confirm dialog.
     * Usage: SIS.confirm({ title, text, confirmText, cancelText }, onConfirm, onCancel)
     */
    function confirm(options, onConfirm, onCancel) {
        var opts = $.extend({
            title: "Are you sure?",
            text: "",
            confirmText: "Yes",
            cancelText: "Cancel"
        }, options);

        swal({
            title: opts.title,
            text: opts.text,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: opts.confirmText,
            cancelButtonText: opts.cancelText,
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm && typeof onConfirm === 'function') {
                onConfirm();
            } else if (!isConfirm && typeof onCancel === 'function') {
                onCancel();
            }
        });
    }

    return {
        formGuard: formGuard,
        showFlash: showFlash,
        confirm: confirm
    };

})(jQuery);
