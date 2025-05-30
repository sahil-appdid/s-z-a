@extends('layouts/contentLayoutMaster')

@section('title', 'Batches')
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
                <livewire:batch-table />
            </x-card>
        </div>
    </div>
</section>


<x-side-modal title="Add Batch" id="add-blade-modal">
    <x-form id="add-batch" method="POST" class="" :route="route('admin.batches.store')">
        <div class="col-md-12 col-12 ">
            <x-select name="subject_id" :options="$subjects"/>
            <x-input name="title" />
        </div>
    </x-form>
</x-side-modal>
<x-side-modal title="Update Batch" id="edit-batch-modal">
    <x-form id="edit-batch" method="POST" class="" :route="route('admin.batches.update')">

        <div class="col-md-12 col-12 ">
            <x-select name="subject_id" :options="$subjects"/>
            <x-input name="title" />
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
        $(`${modal} #subject_id`).val(data.subject);
        $(`${modal} #title`).val(data.title);
        $(modal).modal('show');
    }

</script>
@endsection
