@extends('layouts.my_frame')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if ($layout == 'create')
                    <div class="card-header">{{ __('Register') }}</div>
                @elseif ($layout == 'edit')
                <div class="card-header">{{ __('Edit') }}</div>
                @endif
                
                <div class="card-body">
                    @if ($layout == 'create')
                        <form method="POST" action= "{{ url('admin/courses')}}" enctype="multipart/form-data">
                    @elseif ($layout == 'edit')
                        <form method="POST" action= "{{ url('admin/courses/'.$course->id)}}" enctype="multipart/form-data">
                        @method('PATCH')
                    @endif    
                        @csrf
                        <h4>Basic Info</h4>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $layout=='create' ? old('name') : $course->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ $layout=='create' ? old('description') : $course->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Faculty') }}</label>

                            <div class="col-md-6">

                                <select id="faculty" class="form-control @error('faculty') is-invalid @enderror" name="faculty">
                                    <option value="">--Select Faculty--</option>    
                                    @foreach(['Management','Science & Technology','Medical','Nursing'] as $item)
                                    @if ($layout == 'create')
                                    <option value="{{$item}}">{{$item}}</option>
                                    @elseif ($layout == 'edit')
                                    <option value="{{ $item }}" {{($course->faculty==$item) ? 'selected' : '' }}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="associated_uni" class="col-md-4 col-form-label text-md-right">{{ __('Associated Uni') }}</label>

                            <div class="col-md-6">
                                
                                <select id="associated_uni" class="form-control @error('associated_uni') is-invalid @enderror" name="associated_uni">
                                    <option value="">--Select University--</option>    
                                    @foreach(['Kathmandu University','Tribhuvan University','Pokhara University','Purbanchal University'] as $item)
                                    @if ($layout == 'create')
                                    <option value="{{$item}}">{{$item}}</option>
                                    @elseif ($layout == 'edit')
                                    <option value="{{ $item }}" {{($course->associated_uni==$item) ? 'selected' : '' }}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('associated_uni')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="opportunities" class="col-md-4 col-form-label text-md-right">{{ __('Opportunities') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('opportunities') is-invalid @enderror" id="opportunities" name="opportunities" required>{{ $layout=='create' ? old('opportunities') : $course->opportunities }}</textarea>

                                @error('opportunities')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="online_course" class="col-md-4 col-form-label text-md-right">{{ __('Online Course') }}</label>
                            
                            <div class="col-md-6">
                            
                                <select name="online_course" id="online_course" class="form-control form-control-sm">
                                    @if ($layout == 'create')
                                      <option value="1">Available</option>
                                      <option value="0">Not Available</option>
                                    @elseif ($layout == 'edit')
                                      <option value="1" {{$course->online_course==1?'selected':''}}>Active</option>
                                      <option value="0"{{$course->online_course==0?'selected':''}}>Inactive</option>
                                    @endif
                                </select>

                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="online_exam" class="col-md-4 col-form-label text-md-right">{{ __('Online Exam') }}</label>
                            
                            <div class="col-md-6">
                            
                                <select name="online_exam" id="online_exam" class="form-control form-control-sm">
                                    @if ($layout == 'create')
                                      <option value="1">Available</option>
                                      <option value="0">Not Available</option>
                                    @elseif ($layout == 'edit')
                                      <option value="1" {{$course->online_exam==1?'selected':''}}>Active</option>
                                      <option value="0"{{$course->online_exam==0?'selected':''}}>Inactive</option>
                                    @endif
                                </select>

                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="associated_teacher" class="col-md-4 col-form-label text-md-right">{{ __('Associated Teacher') }}</label>

                            <div class="col-md-6">
                                
                                <select id="associated_teacher" class="form-control @error('associated_teacher') is-invalid @enderror" name="associated_teacher">
                                    <option value="">--Select Associated Teacher--</option>    
                                    @foreach(['Ram Prasad','Hari Bahadur','Shree Krishna','Pradip Bhattrai'] as $item)
                                    @if ($layout == 'create')
                                    <option value="{{$item}}">{{$item}}</option>
                                    @elseif ($layout == 'edit')
                                    <option value="{{ $item }}" {{($course->associated_teacher==$item) ? 'selected' : '' }}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('associated_teacher')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>                            
                         
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        $(function () {
            CKEDITOR.replace('description');
            CKEDITOR.replace('opportunities');
            $(".courses").addClass('active');
            @if ($layout == 'create')
                $(".courses_create").addClass('active');
            @endif    
            });
</script>

@endsection
