<?php include 'app/views/shares/header.php'; ?>
<h1>Danh mục sản phẩm</h1>
<a href="/webbanhang/category/add" class="btn btn-success mb-3">Thêm danh mục</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <!-- <th>STT</th> -->
            <th>Tên danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <!-- <td><?= $category->id ?></td> -->
                <td><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="/webbanhang/category/edit/<?= $category->id ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/webbanhang/category/delete/<?= $category->id ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa danh mục này?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'app/views/shares/footer.php'; ?>