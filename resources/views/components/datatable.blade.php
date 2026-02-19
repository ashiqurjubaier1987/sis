<div>

    {{-- Toggle Buttons --}}
    <div style="margin-bottom:15px;">
        <button onclick="switchView('table')">Table View</button>
        <button onclick="switchView('card')">Card View</button>
        {{-- <button onclick="exportData('csv')">Export CSV</button>
        <button onclick="exportData('excel')">Export Excel</button> --}}
    </div>

    {{-- Table --}}
    <div id="table-container">
        <table id="{{ $id }}" class="table table-bordered">
            <thead>
                <tr>
                    @foreach($columns as $column)
                        <th>{{ $column['label'] }}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
    </div>

    {{-- Card Container --}}
    <div id="card-container" style="display:none;">
        hello
    </div>

</div>

@push('scripts')
<script>
let currentView = 'table';

function switchView(view){
    currentView = view;

    if(view==='table'){
        $('#table-container').show();
        $('#card-container').hide();
    } else {
        $('#table-container').hide();
        $('#card-container').show();
    }
}

// function exportData(type){
//     window.location = "{{-- $exportRoute --}}?type=" + type;
// }

$(function(){
    let table = $('#{{ $id }}').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ $ajaxRoute }}",
        columns: @json($columns),
        drawCallback: function(settings){
            if(currentView==='card'){
                let data = table.rows().data();
                let html = '';
                data.each(function(row){
                    html += `<div style="border:1px solid #ccc;padding:10px;margin:10px;">`;
                    @foreach($columns as $column)
                        html += `<p><strong>{{ $column['label'] }}:</strong> ${row.{{ $column['data'] }} ?? ''}</p>`;
                    @endforeach
                    html += `</div>`;
                });
                $('#card-container').html(html);
            }
        }
    });
});
</script>
@endpush
