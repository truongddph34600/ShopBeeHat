<?php
// Lấy danh sách màu
$sql = "SELECT * FROM Mau";
$rs = mysqli_query($conn, $sql);
?>

<div class="container-fluid">
	<div class="alert alert-primary">
		<h4 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2"></span>
			ADMIN - ONI SHOES
			<i class="fas fa-chevron-right" style="font-size: 18px"></i> Sản Phẩm
			<i class="fas fa-chevron-right" style="font-size: 18px"></i> Màu
		</h4>
	</div>
	<br>

	<div class="card">
		<div class="card-body">
			<?php include_once('main.php') ?>

			<?php if (mysqli_num_rows($rs) > 0): ?>
				<table class="table table-hover m-auto text-center" style="font-size: 13px;">
					<thead class="badge-info">
						<tr>
							<th>ID Màu</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = mysqli_fetch_assoc($rs)): ?>
							<tr>
								<td><?= htmlspecialchars($row['MaMau']) ?></td>
								<td>
									<a href="index.php?action=mau&view=suamau&mamau=<?= urlencode($row['MaMau']) ?>" title="Sửa">
										<i class="far fa-edit"></i>
									</a>
								</td>
								<td>
									<a href="mau/main.php?view=xoamau&mamau=<?= urlencode($row['MaMau']) ?>" title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá màu này?')">
										<i class="fas fa-backspace text-danger"></i>
									</a>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p class="text-center text-muted">Không có màu nào trong hệ thống.</p>
			<?php endif; ?>
		</div>
	</div>
</div>