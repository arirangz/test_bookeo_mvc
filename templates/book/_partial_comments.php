<?php

use App\Entity\User;

?>

        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body p-4">
                    <h2>Commentaires</h2>
                    <?php if (!(empty($comments))) { ?>
                        <div class="row">
                            <div class="col">
                                <?php foreach ($comments as $comment) {
                                    /** @var \App\Entity\Comment $comment */ ?>
                                    <div class="d-flex flex-start bg-body-tertiary p-2 my-1">

                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1">
                                                        <span class="small">
                                                            <?= htmlspecialchars($comment->getUser()->getFirstName()); ?> - Le <?= $comment->getCreatedAt()->format('d/m/Y à H:i:s') ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <p class="small mb-0">
                                                    <?= nl2br(htmlspecialchars($comment->getComment())); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    <?php } else { ?>
                        <h3>Pas de commentaire, soyez le premier à commenter</h3>
                    <?php } ?>

                    <?php
                    if (User::isLogged()) {
                        /** @var \App\Entity\Book $book */
                    ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Commenter</label>
                                <textarea type="text" class="form-control <?= (isset($errors['comment']))  ? ('is-invalid') : ''; ?>" id="comment" name="comment" rows="5"><?= htmlspecialchars($newComment->getComment()); ?></textarea>
                                <?php if (isset($errors['comment'])) { ?>
                                    <div class="invalid-feedback"><?= $errors['comment']; ?></div>
                                <?php } ?>
                            </div>
                            <input type="hidden" name="book_id" value="<?= $newComment->getBookId(); ?>">
                            <input type="hidden" name="user_id" value="<?= $newComment->getUserId(); ?>">



                            <input type="submit" name="saveComment" class="btn btn-primary" value="Commenter">

                        </form>
                    <?php } else { ?>
                        <strong>Vous devez vous connecter pour commenter</strong>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
