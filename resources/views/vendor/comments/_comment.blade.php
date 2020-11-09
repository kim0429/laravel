@inject('markdown', 'Parsedown')
@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
@endphp

<div id="comment-{{ $comment->getKey() }}" class="media">
     <img class="mr-3 com-thumb rounded-circle" src="{{asset('/avatar/').'/'.$comment->commenter->avatar }}" alt="{{ $comment->commenter->nickname}} 사진">
    <div class="media-body">
        <div class="border-bottom">
            <h5 class="mt-0 mb-1 com-nickname">{{ $comment->commenter->nickname}} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }} &nbsp ({{DateTime::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('Y.m.d H:i:s')}})
                &nbsp;
                <div class="float-right">
                @can('edit-comment', $comment)
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase p-0 com-reply kr-font">@lang('comments::comments.edit')</button>
                @endcan
                @can('delete-comment', $comment)
                    <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="btn btn-sm btn-link com-reply p-0 kr-font text-uppercase">@lang('comments::comments.delete')</a>
                    <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                @endcan
                </div>
            </small>
            </h5>
            <div class="com-text p-1">{!! $markdown->line($comment->comment) !!}</div>

            <div>
                @can('reply-to-comment', $comment)
                    <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase p-0 com-reply kr-font">@lang('comments::comments.reply')</button>
                @endcan
               
            </div>
        </div>

        @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                            @method('PUT')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">@lang('comments::comments.update_your_message_here')</label>
                                    <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.update')</button>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        

        <br />{{-- Margin bottom --}}
        @can('reply-to-comment', $comment)
        <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                            <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                                <textarea required class="form-control" name="message" rows="3"></textarea>
                               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                            <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
        <?php
            if (!isset($indentationLevel)) {
                $indentationLevel = 1;
            } else {
                $indentationLevel++;
            }
        ?>

        {{-- Recursion for children --}}
        @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
            {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
            @foreach($grouped_comments[$comment->getKey()] as $child)
                @include('comments::_comment', [
                    'comment' => $child,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif

    </div>
</div>

{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
    {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
    @foreach($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments
        ])
    @endforeach
@endif