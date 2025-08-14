<div class='d-flex justify-content-end'>
    @php
        print_r($right_panel);
    @endphp
    @if(isset($right_panel['add_new']))
        <a href='{{ $right_panel['add_new'] }}' class='btn btn-success btn-md btn-flat mr-2 text-white'><i class='fa fa-plus'></i> Add New </a>
    @endif
    @if(isset($right_panel['back_to_list']))
        <a href='{{ $right_panel['back_to_list'] }}' class='btn btn-primary btn-md btn-flat'><i class='fa fa-undo'></i> Back to List</a>
    @endif
</div>