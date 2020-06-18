@extends('layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Create Feedback:</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form role="form" method="post" action="{{ url('admin/feedbacks')}}" class="form-group"  enctype="multipart/form-data" >
                    <div class="box-body">
                        @csrf

                        <div class="form-group">
                            <label for="project_id">Project : </label>
                            <select id="project_id" class="form-control" name="project_id">
                                @foreach($projects as $item)
                                    <option value="{{$item->id}}" {{$item==old('user_id')?'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input class="form-control" id="title" name="title" type="text" value="{{old('title')}}" required>
                            @error('title')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message">Message: </label>
                            <textarea class="form-control" id="message" name="message" required>{{old('message')}}</textarea>
                            @error('message')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file">file: </label>
                            <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx" class="control-label">

                            @error('file')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" >Status: </label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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
        $(function () {
            CKEDITOR.replace('message');
            $(".projects").addClass('active');
            $(".feedbacks_create").addClass('active');
            $(".select_group").select2();
        });
    </script>
@endsection
