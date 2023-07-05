<div class="newsletter form-content-{{ $form->system_name }} mb-4 position-relative">
    <x-isite::edit-link link="/iadmin/#/form/fields/{{$form->id}}"
                        :tooltip="trans('iforms::common.editLink.tooltipForm')"/>
  @if($titleComponentActive)
    @include("ibuilder::frontend.partials.title")
  @else
    <h4 class="title {{$titleClasses}}">{{ $title ?? $form->title }}</h4>
    @if(!empty($description))
    <p class="description {{$descriptionClasses}}">{{ $description }}</p>
    @endif
  @endif
  <form id="form{{ $form->system_name }}" method="post" action="{{ route('api.iforms.leads.create') }}">
    <input type="hidden" name="form_id" value="{{ $form->id }}" required="">
    <div class="input-group">
      <input type="text" class="form-control {{$inputClasses}}"
             placeholder="{{ trans('iforms::fields.form.email.placeholder') }}"
             name="{{ trans('iforms::fields.form.email.name') }}" required
             aria-label="{{ trans('iforms::fields.form.email.label') }}">
      <div class="input-group-append">
        <button class="{{$buttonClasses}}" type="submit">
          {{ $submitLabel }}
        </button>
      </div>
    </div>
    @if(!empty($postDescription))
      <p class="post-description {{$postDescriptionClasses}}">{{ $postDescription }}</p>
    @endif
    <x-isite::captcha formId="{{'form'.$form->system_name }}"/>
  </form>
  <div class="formerror"></div>
</div>
@section('scripts-owl')
  @parent
    <script type="text/javascript" defer>
    $(document).ready(function () {
      var formid = '#form{{ $form->system_name }}';
      $(formid).submit(function (event) {
        event.preventDefault();
        var info = objectifyFormSubscription($(this).serializeArray());
        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          dataType: 'json',
          data:  info,
          success: function (data) {
            $(".form-content-{{ $form->system_name }}").html('<p class="alert bg-primary text-white mb-0 mt-3" role="alert"><span>' + data.data + '</span> </p>');
          },
          error: function (data) {
            var errors = JSON.parse(data.responseJSON.errors);
            for (var x in errors) {
              $(".form-content-{{ $form->system_name }} .formerror").append('<p class="alert alert-danger mb-0 mt-3" role="alert"><span>' + errors[x] + '</span> </p>');
            }
          }
        })
      })
    });

    function objectifyFormSubscription(formArray) {//serialize data function

      var returnArray = {};
      for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
      }
      return returnArray;
    }
  </script>
@stop
