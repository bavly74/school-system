<div class="modal fade" id="delete_exam{{$question->id}}" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('teacher-questions.delete',$question->id)}}" method="post">

            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;"
                        class="modal-title" id="exampleModalLabel">حذف سؤال</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ trans('classroom.Warning_Grade') }} <span class="text-danger">{{$question->title}}</span></p>
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('classroom.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('classroom.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
