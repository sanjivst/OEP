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
                        <form method="POST" action= "{{ url('admin/students')}}" enctype="multipart/form-data">
                    @elseif ($layout == 'edit')
                        <form method="POST" action= "{{ url('admin/students/'.$student->id)}}" enctype="multipart/form-data">
                        @method('PATCH')
                    @endif    
                        @csrf
                        <h4>Basic Info</h4>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $layout=='create' ? old('name') : $student->name }}" required autocomplete="name" autofocus>

                                @error('name')
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
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $layout=='create' ? old('address') : $student->address }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $layout=='create' ? old('phone') : $student->phone }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $layout=='create' ? old('email') : $student->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>

                            <div class="col-md-6">
                                <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ $layout=='create' ? old('nationality') : $student->nationality }}" required autocomplete="nationality" autofocus>

                                @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select id="state" class="form-control @error('state') is-invalid @enderror" name="state">
                                    <option value="">--Select Province--</option>    
                                    @foreach(['Province 1','Province 2','Province 3','Province 4', 'Province 5', 'Province 6', 'Province 7'] as $item)
                                        @if ($layout == 'create')
                                            <option value="{{ $item }}">{{$item}}</option>
                                        @elseif ($layout == 'edit')
                                            <option value="{{ $item }}" {{($student->state==$item) ? 'selected' : '' }}>{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_code" class="col-md-4 col-form-label text-md-right">{{ __('Post Code') }}</label>

                            <div class="col-md-6">
                                <input id="post_code" type="number" class="form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ $layout=='create' ? old('post_code') : $student->post_code }}" required autocomplete="post_code" autofocus>

                                @error('post_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="previous_course" class="col-md-4 col-form-label text-md-right">{{ __('Previous Course') }}</label>

                            <div class="col-md-6">

                                <select id="previous_course" class="form-control @error('previous_course') is-invalid @enderror" name="previous_course">
                                    <option value="">--Select Previous Course--</option>    
                                    @foreach(['MBBS','MBA','BDS','IELTS'] as $item)
                                    @if ($layout == 'create')
                                    <option value="{{$item}}">{{$item}}</option>
                                    @elseif ($layout == 'edit')
                                    <option value="{{ $item }}" {{($student->previous_course==$item) ? 'selected' : '' }}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('previous_course')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="selected_course" class="col-md-4 col-form-label text-md-right">{{ __('Select Course') }}</label>

                            <div class="col-md-6">
                                
                                <select id="selected_course" class="form-control @error('selected_course') is-invalid @enderror" name="selected_course">
                                    <option value="">--Select Course--</option>    
                                    @foreach(['MBBS','MBA','BDS','IELTS'] as $item)
                                    @if ($layout == 'create')
                                    <option value="{{$item}}">{{$item}}</option>
                                    @elseif ($layout == 'edit')
                                    <option value="{{ $item }}" {{($student->selected_course==$item) ? 'selected' : '' }}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('selected_course')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="package_selected" class="col-md-4 col-form-label text-md-right">{{ __('Select Package') }}</label>

                            <div class="col-md-6">
                                <select id="package_selected" class="form-control @error('package_selected') is-invalid @enderror" name="package_selected">
                                    <option value="">--Select Package--</option>    
                                    @foreach(['Standard','Premium'] as $item)
                                    @if ($layout == 'create')
                                        <option value="{{$item}}">{{$item}}</option>
                                    @elseif ($layout == 'edit')
                                        <option value="{{ $item }}" {{($student->package_selected==$item) ? 'selected' : '' }}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('package_selected')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{--                        <div class="form-group row">--}}
{{--                            <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <textarea id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" required autocomplete="" autofocus>{{ old('message') }}</textarea>--}}

{{--                                @error('message')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="course_info" class="col-md-4 col-form-label text-md-right">{{ __('Course Info') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="course_info" type="file" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="form-control @error('course_info') is-invalid @enderror" name="course_info" value="{{ old('course_info') }}" required autocomplete="course_info" autofocus>--}}

{{--                                @error('course_info')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="payment" class="col-md-4 col-form-label text-md-right">{{ __('Payment') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <select id="payment" class="form-control @error('payment') is-invalid @enderror" name="payment">--}}
{{--                                    @foreach(['Paid','Unpaid'] as $item)--}}
{{--                                        <option value="{{$item}}">{{$item}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('payment')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

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
            $(".students").addClass('active');
            @if ($layout == 'create')
                $(".students_create").addClass('active');
            @endif    
            // CKEDITOR.replace('message');
        });
</script>

@endsection
