<main class="container">
    <form>
        <div class="form-group">
            <label for="size">Page size</label>
            <select name="size" id="size">
                <?php foreach ($possibilePageSizes as $pagesize) : ?>
                    <option <?php if ($pagesize == $size) : ?> selected="selected" <?php endif; ?>><?= $pagesize ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
    </form>
    <?php require "pagination.php"; ?>
    <?php foreach ($content as $picture) : ?>
        <img title="<?php echo $picture['title'] ?>" src="<?php echo $picture['thumbnail'] ?>" />
    <?php endforeach; ?>
    <?php require "pagination.php"; ?>
</main>