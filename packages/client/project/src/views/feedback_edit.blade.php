@extends('layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Update Feedback:</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form role="form" method="post" action="{{ url('admin/feedbacks/'.$feedback->id)}}" class="form-group"  enctype="multipart/form-data" >
                    <div class="box-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="project_id">Project : </label>
                            <select id="project_id" class="form-control" name="project_id">
                                @foreach($projects as $item)
                                    <option value="{{$item->id}}" {{($item->id==$feedback->project_id)?'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input class="form-control" id="title" name="title" type="text" value="{{old('title',$feedback->title)}}" required>
                            @error('title')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message">Message: </label>
                            <textarea class="form-control" id="message" name="message" required>{{old('message',$feedback->message)}}</textarea>
                            @error('message')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file" class=" control-label">file: </label>
                            <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx" class="form-control">
                            @error('file')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" >Status: </label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="1" {{$feedback->status==1?'selected':''}}>Active</option>
                                <option value="0"{{$feedback->status==0?'selected':''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success"  type="submit" id="submit" >Submit</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(".projects").addClass('active');
        $(function () {
            CKEDITOR.replace('message');
            $(".feedbacks").addClass('active');
            $(".feedbacks_edit").addClass('active');
            $('.popup').click(function (event) {
                event.preventDefault();
                window.open('{{url('admin/select-image')}}', "popupWindow", "width=600,height=400,scrollbars=yes");
            });
            $(".select_group").select2();
        });

    </script>
@endsection
