<?php $__env->startSection('title', $news->meta_title); ?>
<?php $__env->startSection('meta_description', $news->meta_description); ?>

<?php $__env->startPush('meta'); ?>
<meta property="og:title" content="<?php echo e($news->meta_title); ?>">
<meta property="og:description" content="<?php echo e($news->meta_description); ?>">
<meta property="og:image" content="<?php echo e(asset('storage/' . $news->featured_image)); ?>">
<meta property="og:url" content="<?php echo e(url()->current()); ?>">
<meta property="og:type" content="article">
<meta property="article:published_time" content="<?php echo e($news->created_at->toISOString()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('news.index')); ?>">News</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('news.index', ['category' => $news->category->slug])); ?>"><?php echo e($news->category->name); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(Str::limit($news->title, 50)); ?></li>
        </ol>
    </div>
</nav>

<!-- Article Content -->
<article class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Article Header -->
                <header class="mb-4">
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6"><?php echo e($news->category->name); ?></span>
                    </div>
                    <h1 class="display-5 fw-bold mb-3"><?php echo e($news->title); ?></h1>
                    <div class="d-flex flex-wrap align-items-center text-muted mb-4">
                        <span class="me-3">
                            <i class="fas fa-calendar me-1"></i><?php echo e($news->created_at->format('F j, Y')); ?>

                        </span>
                        <span class="me-3">
                            <i class="fas fa-eye me-1"></i><?php echo e(number_format($news->view_count)); ?> views
                        </span>
                        <span class="me-3">
                            <i class="fas fa-heart me-1"></i><span id="like-count"><?php echo e(number_format($news->like_count)); ?></span> likes
                        </span>
                        <span>
                            <i class="fas fa-comments me-1"></i><?php echo e($comments->count()); ?> comments
                        </span>
                    </div>
                </header>

                <!-- Featured Image -->
                <div class="mb-4">
                    <img src="<?php echo e(asset('storage/' . $news->featured_image)); ?>"
                         class="img-fluid rounded shadow"
                         alt="<?php echo e($news->title); ?>"
                         style="width: 100%; height: 400px; object-fit: cover;">
                </div>

                <!-- Article Content -->
                <div class="article-content mb-5">
                    <?php echo $news->description; ?>

                </div>

                <!-- Article Actions -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-5 p-3 bg-light rounded">
                    <div class="d-flex gap-2 mb-2 mb-md-0">
                        <button id="like-btn" class="btn btn-outline-danger" onclick="likeArticle(<?php echo e($news->id); ?>)">
                            <i class="fas fa-heart me-1"></i>
                            <span id="like-text">Like</span>
                        </button>
                        <button class="btn btn-outline-primary" onclick="shareArticle()">
                            <i class="fas fa-share-alt me-1"></i>Share
                        </button>
                    </div>
                    <div>
                        <small class="text-muted">Article ID: #<?php echo e($news->id); ?></small>
                    </div>
                </div>

                <!-- Comments Section -->
                <section class="mb-5">
                    <h3 class="mb-4">
                        <i class="fas fa-comments me-2"></i>Comments (<?php echo e($comments->count()); ?>)
                    </h3>

                    <!-- Comment Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Leave a Comment</h5>
                            <form id="comment-form">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="comment-name"
                                               placeholder="Your Name *" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="email" class="form-control" id="comment-email"
                                               placeholder="Your Email (Optional)">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="comment-text" rows="4"
                                              placeholder="Your comment *" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Comment
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Comments List -->
                    <?php if($comments->count() > 0): ?>
                        <div class="comments-list">
                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0"><?php echo e($comment->name); ?></h6>
                                            <small class="text-muted"><?php echo e($comment->created_at->diffForHumans()); ?></small>
                                        </div>
                                        <p class="mb-2"><?php echo e($comment->comment); ?></p>

                                        <?php if($comment->replies->count() > 0): ?>
                                            <div class="ms-4 mt-3">
                                                <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="card bg-light mb-2">
                                                        <div class="card-body py-2">
                                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                                <h6 class="mb-0 small">
                                                                    <i class="fas fa-reply me-1"></i><?php echo e($reply->name); ?>

                                                                    <?php if($reply->name === 'Admin'): ?>
                                                                        <span class="badge bg-primary ms-1">Admin</span>
                                                                    <?php endif; ?>
                                                                </h6>
                                                                <small class="text-muted"><?php echo e($reply->created_at->diffForHumans()); ?></small>
                                                            </div>
                                                            <p class="mb-0 small"><?php echo e($reply->comment); ?></p>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-comments display-4 text-muted mb-3"></i>
                            <p class="text-muted">No comments yet. Be the first to comment!</p>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </div>
</article>

<!-- Related Articles -->
<?php if($relatedNews->count() > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Related Articles</h2>
        <div class="row">
            <?php $__currentLoopData = $relatedNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedArticle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card news-card h-100">
                    <img src="<?php echo e(asset('storage/' . $relatedArticle->featured_image)); ?>"
                         class="card-img-top"
                         alt="<?php echo e($relatedArticle->title); ?>"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary mb-2 align-self-start"><?php echo e($relatedArticle->category->name); ?></span>
                        <h5 class="card-title"><?php echo e($relatedArticle->title); ?></h5>
                        <p class="card-text text-muted small flex-grow-1">
                            <?php echo e(Str::limit(strip_tags($relatedArticle->description), 80)); ?>

                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i><?php echo e(number_format($relatedArticle->view_count)); ?>

                            </small>
                            <a href="<?php echo e(route('news.show', $relatedArticle->slug)); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-right me-1"></i>Read
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $__env->startPush('styles'); ?>
<style>
.article-content {
    font-size: 1.1rem;
    line-height: 1.7;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1rem 0;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Like functionality
async function likeArticle(newsId) {
    const btn = document.getElementById('like-btn');
    const likeCount = document.getElementById('like-count');
    const likeText = document.getElementById('like-text');

    btn.disabled = true;

    try {
        const response = await fetch(`/news/${newsId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            }
        });

        const data = await response.json();

        if (data.success) {
            likeCount.textContent = new Intl.NumberFormat().format(data.like_count);
            likeText.textContent = 'Liked';
            btn.classList.remove('btn-outline-danger');
            btn.classList.add('btn-danger');
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    } finally {
        btn.disabled = false;
    }
}

// Comment submission
document.getElementById('comment-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';

    try {
        const response = await fetch(`/news/<?php echo e($news->id); ?>/comment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                name: document.getElementById('comment-name').value,
                email: document.getElementById('comment-email').value,
                comment: document.getElementById('comment-text').value
            })
        });

        const data = await response.json();

        if (data.success) {
            alert(data.message);
            form.reset();
        } else {
            alert('Please check your input and try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});

// Share functionality
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '<?php echo e($news->title); ?>',
            text: '<?php echo e($news->meta_description); ?>',
            url: window.location.href
        }).then(() => {
            console.log('Article shared successfully');
        }).catch((error) => {
            console.log('Error sharing:', error);
            fallbackShare();
        });
    } else {
        fallbackShare();
    }
}

function fallbackShare() {
    const url = window.location.href;

    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            alert('Article link copied to clipboard!');
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Article link copied to clipboard!');
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\3smarkerting\my_project_name\resources\views/news/show.blade.php ENDPATH**/ ?>