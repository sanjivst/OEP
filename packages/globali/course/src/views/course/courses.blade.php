@extends('layouts.my_frame')
@section('title','Course List')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table id="news_list" class="table table-bordered">
                        <thead>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Faculty</th>
                        <th>Associated Uni</th>
                        <th>Opportunities</th>
                        <th>Online Course</th>
                        <th>Online Exam</th>
                        <th>Associated Teacher</th>
                        </thead>
                        <tbody>

                        @if($course)
                            @foreach($course as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ substr(strip_tags($item->description), 0, 50) }}</td>
                                    <td>
                                        <img src="{{url('storage/'.$item->image)}}" alt="{{$item->name}}" height="100">
                                    </td>
                                    <td>{{$item->faculty}}</td>
                                    <td>{{$item->associated_uni}}</td>
                                    <td>{{ substr(strip_tags($item->opportunities), 0, 50) }}</td>
                                    <td>{{ $item->online_course==1 ? 'Available' : 'Not Available' }}</td>
                                    <td>{{ $item->online_exam==1 ? 'Available' : 'Not Available' }}</td>
                                    <td>{{$item->associated_teacher}}</td>
                                    
                                    <td><a href="{{url('admin/courses/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>

                                    <td>
                                        <form method="post" action="{{url('admin/courses/'.$item->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button style="border-radius:50%" onclick="return confirm('Do you want to delete this?')" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $(".courses").addClass('active');
            $(".courses_list").addClass('active');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#news_list').DataTable( {
                "scrollX": true
            } );
        } );
        $('.courses').addClass('active');
        $('.courses_list').addClass('active');
    </script>
@endsection
