<?php

use App\Entity\User;

?>


<div class="card">




    <div class="card-body p-4">

        <div class="row mb-3">
            <h2>Note des utilisateurs</h2>
            <?php if ($averageRate) { ?>
                <div class="row align-items-center justify-content-center">
                    <div class="rate col-6">
                        <?php for ($i = 5; $i > 0; $i--) { ?>
                            <input disabled="disabled" type="radio" id="avgstar<?= $i ?>" name="avgrate" value="<?= $i ?>" <?= ($averageRate ===  $i) ? 'checked="checked"' : '' ?> />
                            <label for="avgstar<?= $i ?>" title="<?= $i ?> étoiles"><?= $i ?> étoiles</label>
                        <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-primary" role="alert">
                    Il n'y a pas encore de note pour ce livre
                </div>
            <?php } ?>
        </div>

        <div class="row mb-3">
            <h3>Noter ce livre</h3>

            <?php
            if (User::isLogged()) {
                /** @var \App\Entity\Rating $rating */
            ?>
                <form method="POST">
                    <div class="mb-3">
                        <div class="row" class="is-invalid">
                            <div class="col-4 py-2">
                                <label for="rate" class="form-label">Votre note :</label>

                            </div>
                            <div class="col-8">
                                <div class="rate enabled">
                                    <?php for ($i = 5; $i > 0; $i--) { ?>
                                        <input type="radio" id="star<?= $i ?>" name="rate" value="<?= $i ?>" <?= ($rating->getRate() ===  $i) ? 'checked="checked"' : '' ?> />
                                        <label for="star<?= $i ?>" title="<?= $i ?> étoiles"><?= $i ?> étoiles</label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($errors['rate'])) { ?>
                            <div class="is-invalid"></div>
                            <div class="invalid-feedback"><?= $errors['rate']; ?></div>
                        <?php } ?>
                    </div>

                    <input type="hidden" name="book_id" value="<?= $rating->getBookId(); ?>">
                    <input type="hidden" name="user_id" value="<?= $rating->getUserId(); ?>">

                    <?php if ($rating->getId()) { ?>
                        <input type="hidden" name="id" value="<?= $rating->getId(); ?>">
                    <?php } ?>

                    <?php if (empty($errors) && isset($_POST['saveRating'])) { ?>
                        <div class="alert alert-success" role="alert">
                            Votre note a bien été prise en compte !
                        </div>
                    <?php } ?>


                    <div class="mb-3">
                        <input type="submit" name="saveRating" class="btn btn-primary form-control " value="Noter">
                    </div>

                </form>
            <?php } else { ?>
                <strong>Vous devez vous connecter pour noter ce livre.</strong>
            <?php }
            ?>
        </div>



    </div>
</div>