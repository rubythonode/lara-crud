<div class="form-group">
    <label for="{{$obj->name}}" class="col-md-1 control-label">{{$obj->label}} @if(($obj->tooltip))<i class="fa fa-fw fa-info-circle" data-toggle="tooltip" data-placement="{{$obj->tooltip}}" data-title="{{$obj->title}}"></i>@endif</label>
    <div class="col-md-9">
        <textarea id="{{$obj->name}}" class="form-control {{$obj->enableEditor ? 'editor-textarea': '' }} {{$obj->classStyle}}"
                  name="{{$obj->name}}" rows="3"
                  placeholder="{{$obj->placeholder}}">
            {{$obj->value}}
        </textarea>
    </div>
    <script>
        $(function () {

            CKEDITOR.replace('{{$obj->name}}', {
                filebrowserImageUploadUrl : "/home/vagrant/Code/crud/www/public/upload/image",
                filebrowserWindowWidth  : 800,
                filebrowserWindowHeight : 500

            });
        });
    </script>
</div>