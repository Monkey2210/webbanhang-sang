<?php include 'app/views/shares/header.php'; ?>
<h1>Sửa danh mục</h1>

<form method="POST" action="/webbanhang/category/edit/<?= $category->id ?>">
    <div class="form-group">
        <label for="name">Tên danh mục:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<a href="/webbanhang/category" class="btn btn-secondary mt-2">Quay lại</a>

<?php include 'app/views/shares/footer.php'; ?>