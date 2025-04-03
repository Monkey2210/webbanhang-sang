<?php include 'app/views/shares/header.php'; ?>
<h1>Sửa danh mục</h1>

<?php if (isset($category) && $category !== null): ?>
    <form method="POST" action="<?php echo '/webbanhang/category/edit/' . (isset($category->id) ? $category->id : ''); ?>">
        <div class="form-group">
            <label for="name">Tên danh mục:</label>
            <input type="text" id="name" name="name"
                value="<?php echo isset($category->name) ? htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') : ''; ?>"
                class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
<?php else: ?>
    <div class="alert alert-danger">
        Không tìm thấy danh mục hoặc danh mục không hợp lệ.
    </div>
<?php endif; ?>

<a href="/webbanhang/category" class="btn btn-secondary mt-2">Quay lại</a>

<?php include 'app/views/shares/footer.php'; ?>