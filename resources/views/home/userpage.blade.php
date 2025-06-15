<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>Famms</title>
   <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}" />
   <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('home/css/style.css') }}" />
   <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}" />

   <style>
      /* Instagram-style comment section */
      .comment-box {
         max-width: 600px;
         margin: 0 auto;
         background: #fff;
         border-radius: 12px;
         box-shadow: 0 4px 12px rgba(0,0,0,0.1);
         padding: 20px;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .comment-box h2 {
         font-weight: 700;
         margin-bottom: 20px;
         border-bottom: 1px solid #ddd;
         padding-bottom: 10px;
         color: #333;
      }
      textarea.form-control {
         border-radius: 12px;
         resize: none;
         box-shadow: none;
         border: 1px solid #ddd;
         transition: border-color 0.3s;
      }
      textarea.form-control:focus {
         border-color: #0095f6;
         box-shadow: 0 0 5px rgba(0,149,246,0.5);
         outline: none;
      }
      button.btn-primary, button.btn-secondary {
         border-radius: 50px;
         padding: 8px 24px;
         font-weight: 600;
         text-transform: uppercase;
         letter-spacing: 1px;
      }
      .comment-list {
         margin-top: 30px;
      }
      .comment-item {
         display: flex;
         align-items: flex-start;
         margin-bottom: 25px;
         border-bottom: 1px solid #eee;
         padding-bottom: 15px;
      }
      .comment-avatar {
         width: 48px;
         height: 48px;
         border-radius: 50%;
         overflow: hidden;
         margin-right: 15px;
         background: #ccc;
         flex-shrink: 0;
      }
      .comment-avatar img {
         width: 100%;
         height: 100%;
         object-fit: cover;
      }
      .comment-content {
         flex: 1;
      }
      .comment-user {
         font-weight: 700;
         color: #262626;
         margin-bottom: 5px;
      }
      .comment-text {
         color: #555;
         font-size: 14px;
         line-height: 1.3;
      }
      .reply-list {
         margin-left: 60px;
         margin-top: 15px;
         border-left: 2px solid #f0f0f0;
         padding-left: 15px;
      }
      .reply-item {
         display: flex;
         align-items: flex-start;
         margin-bottom: 15px;
      }
      .reply-avatar {
         width: 36px;
         height: 36px;
         border-radius: 50%;
         overflow: hidden;
         margin-right: 10px;
         background: #ccc;
         flex-shrink: 0;
      }
      .reply-avatar img {
         width: 100%;
         height: 100%;
         object-fit: cover;
      }
      .reply-content {
         flex: 1;
      }
      .reply-user {
         font-weight: 600;
         color: #444;
         margin-bottom: 3px;
         font-size: 13px;
      }
      .reply-text {
         color: #666;
         font-size: 13px;
         line-height: 1.2;
      }
      .reply-link {
         cursor: pointer;
         font-size: 13px;
         color: #0095f6;
         margin-top: 5px;
         display: inline-block;
      }
      .dynamic-reply-form {
         margin-top: 10px;
      }
      .error-message {
         color: red;
         font-size: 13px;
         margin-top: 5px;
      }
      .success-message {
         color: green;
         font-size: 14px;
         margin-top: 10px;
         text-align: center;
      }
   </style>
</head>
<body>
   @include('sweetalert::alert')

<div class="hero_area">
   @include('home.header')
   @include('home.slider')
</div>

@include('home.why')
@include('home.arrival')
@include('home.products')

<!-- Comment Section -->
<div class="container my-5">
   <div class="comment-box">
      <h2>Leave a Comment</h2>
      <form id="commentForm" method="POST" action="{{ route('comment.store') }}">
         @csrf
         <textarea name="comment" id="commentInput" class="form-control" rows="4" placeholder="Write your comment here..." required></textarea>
         <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Submit Comment</button>
         </div>
      </form>
      <div id="commentSuccess" class="success-message" style="display:none;">Comment posted successfully!</div>
      <div id="commentError" class="error-message" style="display:none;"></div>

      <!-- Show Comments and Replies -->
      <div class="comment-list mt-5" id="commentsContainer">
         <h4>All Comments</h4>

         @foreach($comments as $comment)
         <div class="comment-item" data-comment-id="{{ $comment->id }}">
            <div class="comment-avatar">
               @if($comment->user->profile_photo_url)
               <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}">
               @else
               <img src="https://via.placeholder.com/48" alt="User">
               @endif
            </div>
            <div class="comment-content">
               <div class="comment-user">{{ $comment->user->name }}</div>
               <div class="comment-text">{{ $comment->comment }}</div>

               <div class="reply-list">
                  @foreach($comment->replies as $reply)
                  <div class="reply-item" data-reply-id="{{ $reply->id }}">
                     <div class="reply-avatar">
                        @if($reply->user->profile_photo_url)
                        <img src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->name }}">
                        @else
                        <img src="https://via.placeholder.com/36" alt="User">
                        @endif
                     </div>
                     <div class="reply-content">
                        <div class="reply-user">{{ $reply->user->name }}</div>
                        <div class="reply-text">{{ $reply->reply_content }}</div>
                     </div>
                  </div>
                  @endforeach
               </div>

               <!-- Reply link -->
               <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}">Reply</a>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>

@include('home.subscribe')
@include('home.client')
@include('home.footer')

<div class="cpy_">
   <p class="mx-auto">© 2021 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a><br>
      Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
   </p>
</div>

<!-- Scripts -->
<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.js') }}"></script>
<script src="{{ asset('home/js/custom.js') }}"></script>
<script>
$(document).ready(function () {
   // Remove any existing reply forms
   function removeReplyForms() {
      $('.dynamic-reply-form').remove();
      $('#replyError').remove();
      $('#replySuccess').remove();
   }

   // Show reply form under the comment
   $('.reply-link').click(function (e) {
      e.preventDefault();
      removeReplyForms();

      const commentId = $(this).data('comment-id');
      const container = $(this).closest('.comment-content');
      const csrf = '{{ csrf_token() }}';

      const formHtml = `
         <form class="dynamic-reply-form" method="POST" action="{{ route('reply.store') }}">
            <input type="hidden" name="_token" value="${csrf}">
            <input type="hidden" name="comment_id" value="${commentId}">
            <textarea name="reply_content" class="form-control mt-2" rows="2" placeholder="Write your reply..." required></textarea>
            <button type="submit" class="btn btn-sm btn-secondary mt-2">Post Reply</button>
         </form>
         <div id="replyError" class="error-message" style="display:none;"></div>
         <div id="replySuccess" class="success-message" style="display:none;"></div>
      `;

      container.append(formHtml);
   });

   // AJAX submit for new comment
   $('#commentForm').submit(function(e) {
      e.preventDefault();
      $('#commentError').hide();
      $('#commentSuccess').hide();

      const form = $(this);
      const url = form.attr('action');
      const data = form.serialize();

      $.post(url, data)
         .done(function(response) {
            // Assuming response contains the new comment with user info
            // You need to adjust based on your API response format
            const comment = response.comment;
            const user = comment.user;

            // Build new comment HTML (same structure as above)
            const newCommentHtml = `
               <div class="comment-item" data-comment-id="${comment.id}">
                  <div class="comment-avatar">
                     <img src="${user.profile_photo_url ?? 'https://via.placeholder.com/48'}" alt="${user.name}">
                  </div>
                  <div class="comment-content">
                     <div class="comment-user">${user.name}</div>
                     <div class="comment-text">${comment.comment}</div>
                     <div class="reply-list"></div>
                     <a href="#" class="reply-link" data-comment-id="${comment.id}">Reply</a>
                  </div>
               </div>
            `;

            $('#commentsContainer').append(newCommentHtml);
            form.trigger('reset');
            $('#commentSuccess').show();

            // Re-bind reply-link click for new comment
            $('.reply-link').off('click').on('click', function(e) {
               e.preventDefault();
               removeReplyForms();

               const commentId = $(this).data('comment-id');
               const container = $(this).closest('.comment-content');
               const csrf = '{{ csrf_token() }}';

               const formHtml = `
                  <form class="dynamic-reply-form" method="POST" action="{{ route('reply.store') }}">
                     <input type="hidden" name="_token" value="${csrf}">
                     <input type="hidden" name="comment_id" value="${commentId}">
                     <textarea name="reply_content" class="form-control mt-2" rows="2" placeholder="Write your reply..." required></textarea>
                     <button type="submit" class="btn btn-sm btn-secondary mt-2">Post Reply</button>
                  </form>
                  <div id="replyError" class="error-message" style="display:none;"></div>
                  <div id="replySuccess" class="success-message" style="display:none;"></div>
               `;

               container.append(formHtml);
            });
         })
         .fail(function(xhr) {
            let errMsg = 'Something went wrong. Please try again.';
            if(xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.comment) {
               errMsg = xhr.responseJSON.errors.comment[0];
            }
            $('#commentError').text(errMsg).show();
         });
   });

   // Delegate submit event for dynamic reply forms
   $(document).on('submit', '.dynamic-reply-form', function(e) {
      e.preventDefault();
      const form = $(this);
      const url = form.attr('action');
      const data = form.serialize();
      const commentContentDiv = form.closest('.comment-content');
      const replyList = commentContentDiv.find('.reply-list').first();
      const errorDiv = form.next('#replyError');
      const successDiv = form.nextAll('#replySuccess').first();

      errorDiv.hide();
      successDiv.hide();

      $.post(url, data)
         .done(function(response) {
            // Assuming response contains the new reply with user info
            const reply = response.reply;
            const user = reply.user;

            const newReplyHtml = `
               <div class="reply-item" data-reply-id="${reply.id}">
                  <div class="reply-avatar">
                     <img src="${user.profile_photo_url ?? 'https://via.placeholder.com/36'}" alt="${user.name}">
                  </div>
                  <div class="reply-content">
                     <div class="reply-user">${user.name}</div>
                     <div class="reply-text">${reply.reply_content}</div>
                  </div>
               </div>
            `;

            replyList.append(newReplyHtml);
            form.remove();
            successDiv.text('Reply posted successfully!').show();
         })
         .fail(function(xhr) {
            let errMsg = 'Something went wrong. Please try again.';
            if(xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.reply_content) {
               errMsg = xhr.responseJSON.errors.reply_content[0];
            }
            errorDiv.text(errMsg).show();
         });
   });
});
</script>

</body>
</html>
