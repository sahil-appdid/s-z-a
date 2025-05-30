@extends('layouts/contentLayoutMaster')

@section('title', 'Zoom-links')
@section('page-style')
<style>
    [x-cloak] {
        display: none !important;
    }

    .dropdown-menu {
        transform: scale(1) !important;
    }
</style>
@endsection

@section('content')


<section>
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <x-card>
                <livewire:zoom-table />
            </x-card>
        </div>
    </div>
</section>


<x-side-modal title="Add Zoom Link" id="add-blade-modal">
    <x-form id="add-zoom-link" method="POST" class="" :route="route('admin.zooms.store')">
        <div class="col-md-12 col-12 ">
            <x-select name="batch_id" :options="$batches"/>
            <x-input name="link" />
        </div>
    </x-form>
</x-side-modal>
<x-side-modal title="Update Batch" id="edit-zoom-modal">
    <x-form id="edit-zoom-link" method="POST" class="" :route="route('admin.zooms.update')">

        <div class="col-md-12 col-12 ">
            <x-select name="batch_id" :options="$batches"/>
            <x-input name="link" />
            <x-input name="id" type="hidden" />
        </div>

    </x-form>
</x-side-modal>
@endsection
@section('page-script')
<script>
    $(document).ready(function() {
        $(document).on('click', '[data-show]', function() {
            const modal = $(this).data('show');
            $(`#${modal}`).modal('show');
        });
    });

    function setValue(data, modal) {

        $(`${modal} #id`).val(data.id);
        $(`${modal} #batch_id`).val(data.batch_id);
        $(`${modal} #link`).val(data.link);
        $(modal).modal('show');
    }

</script>
@endsection
