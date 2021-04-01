<div class="content-form{{$formRand}}">
    <div class="formerror"></div>
    <form id="{{$formId}}" class="form-horizontal" action="{{route('api.iforms.leads.create')}}">
        <input type="hidden" name="form_id" value="{{$form->id}}" required="">

        @include('iforms::frontend.components.form.layouts.form-layout-3.fields')
        <div class="col-sm-12">
            <x-isite::captcha :formId="$formId" />
        </div>
        <div class="w-100 text-right">
            <button type="submit" class="btn btn-primary">{{trans('iforms::forms.form.submit')}}</button>
        </div>
    </form>
</div>
@include('iforms::frontend.components.form.layouts.mainlayout')