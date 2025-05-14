<?php
	$sql="select * from phieugiamgia ";
	$rs=mysqli_query($conn,$sql);

?>
<div class="container-fluid">
    <div class=" alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
            </span> ADMIN &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Mã Giảm Giá
        </h4>    </div><br>
		<div class="row">
			<table class="table table-hover m-auto text-center" >
				<thead class="badge-info" style="font-size: 14px;">
                					<tr>
                						<th>Mã Giảm Giá</th>
                						<th>Giá</th>
                						<th>Mô Tả</th>
                						<th class="badge-danger" colspan="3">Thao tác</th>
                					</tr>
                				</thead>
				<tbody  style="font-size: 12px;">
			 <?php $so=0;
				 while ($row=mysqli_fetch_array($rs)) { ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo number_format($row['SoTien']).' đ'; ?></td>
						<td><?php echo $row['TenPhieu']; ?></td>
						<td><a href="index.php?action=phieugiamgia&view=sua&id=<?php echo $row['id']; ?>" >Sửa<i class="far fa-edit"></i></a></td> <!-- sửa-->
						<td><a href="phieugiamgia/xuly.php?xoa=xoa&id=<?php echo $row['id']; ?>" >Xóa<i class="fas fa-backspace"></i></a></td><!-- xóa-->
					</tr>
			 <?php	} ?>

				</tbody>
			</table>
		</div>
	</div>
</div>
