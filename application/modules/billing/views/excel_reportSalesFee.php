<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=".url_title($report_name.' '.$date_from.' to '.$date_till).".xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

$set_width = 1710;
$total_cols = 16;
		
?>
<html>
<body>
<style>
	<?php include ASSETS_PATH."desktop/css/report.css.php"; ?>
</style>
<div class="report_area" style="width:<?php echo $set_width.'px'; ?>;">
		
	<table width="<?php echo $set_width; ?>">
		<!-- HEADER -->
		<thead>
			<tr>
				<td colspan="<?php echo $total_cols ?>">
					<div>
					
						<div class="title_report_xcenter"><?php echo $report_name;?></div>		
						<div class="subtitle_report_xcenter"><?php echo 'Period : '.$date_from.' TO '.$date_till;?></div>		
						<?php
						if(!empty($sales_name_report)){
							?>
							<div class="subtitle_report_xcenter">SALES: <?php echo $sales_name_report; ?></div>	
							<?php
						}
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="tbl_head_td_first_xcenter" width="50" rowspan="2">NO</td>
				<td class="tbl_head_td_xcenter" width="130" rowspan="2">PAYMENT DATE</td>
				<td class="tbl_head_td_xcenter" width="80" rowspan="2">BILLING NO.</td>
				<td class="tbl_head_td_xcenter" width="120" rowspan="2">TOTAL BILLING</td>
				<?php
				if($diskon_sebelum_pajak_service == 1){
					?>
					<td class="tbl_head_td_xcenter" width="220" colspan="2">DISCOUNT</td>
					<?php
				}
				?>
				<td class="tbl_head_td_xcenter" width="100" rowspan="2">TAX</td>
				<td class="tbl_head_td_xcenter" width="100" rowspan="2">SERVICE</td>
				<td class="tbl_head_td_xcenter" width="100" rowspan="2">SUB TOTAL</td>
				<?php
				if($diskon_sebelum_pajak_service == 0){
					?>
					<td class="tbl_head_td_xcenter" width="220" colspan="2">DISCOUNT</td>
					<?php
				}
				?>
				<td class="tbl_head_td_xcenter" width="100" rowspan="2">PEMBULATAN</td>	
				<td class="tbl_head_td_xcenter" width="100" rowspan="2">COMPLIMENT</td>
				<td class="tbl_head_td_xcenter" width="120" rowspan="2">GRAND TOTAL</td>
				<td class="tbl_head_td_xcenter" width="100" rowspan="2">SALES FEE</td>
				<td class="tbl_head_td" width="100" rowspan="2">SALES NAME</td>
				<td class="tbl_head_td" width="100" rowspan="2">SALES COMPANY</td>
				<td class="tbl_head_td_xcenter" width="200" rowspan="2">NOTE</td>
			</tr>
			<tr>
				
				<?php
				if($diskon_sebelum_pajak_service == 1){
					?>
					<td class="tbl_head_td_xcenter" width="110">ITEM</td>
					<td class="tbl_head_td_xcenter" width="110">BILLING</td>
					<?php
				}
				
				if($diskon_sebelum_pajak_service == 0){
					?>
					<td class="tbl_head_td_xcenter" width="110">ITEM</td>
					<td class="tbl_head_td_xcenter" width="110">BILLING</td>
					<?php
				}
				?>
				
			</tr>
		</thead>
		<tbody>
		<?php
		
			if(!empty($report_data)){
			
				$no = 1;
				$total_billing = 0;
				$total_tax = 0;
				$total_service = 0;
				$grand_total = 0;
				$grand_total_dp = 0;
				$grand_total_sales_fee = 0;
				$grand_sub_total = 0;
				$grand_total_pembulatan = 0;
				$grand_discount_total = 0;
				$grand_discount_billing_total = 0;
				$grand_total_compliment = 0;
				$grand_total_payment = array();
				foreach($report_data as $det){
					?>
					<tr>
						<td class="tbl_data_td_first_xcenter"><?php echo $no; ?></td>
						<td class="tbl_data_td">&nbsp;<?php echo date("Y-m-d", strtotime($det['payment_date'])); ?></td>
						<td class="tbl_data_td"><?php echo $det['billing_no']; ?></td>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['total_billing_show']; ?></td>
						<?php
						if($diskon_sebelum_pajak_service == 1){
							?>
							<td class="tbl_data_td_xright">Rp. <?php echo $det['discount_total_show']; ?></td>
							<td class="tbl_data_td_xright">Rp. <?php echo $det['discount_billing_total_show']; ?></td>
							<?php
						}
						?>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['tax_total_show']; ?></td>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['service_total_show']; ?></td>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['sub_total_show']; ?></td>
						<?php
						if($diskon_sebelum_pajak_service == 0){
							?>
							<td class="tbl_data_td_xright">Rp. <?php echo $det['discount_total_show']; ?></td>
							<td class="tbl_data_td_xright">Rp. <?php echo $det['discount_billing_total_show']; ?></td>
							<?php
						}
						?>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['total_pembulatan_show']; ?></td>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['total_compliment_show']; ?></td>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['grand_total_show']; ?></td>
						<td class="tbl_data_td_xright">Rp. <?php echo $det['total_sales_fee_show']; ?></td>
						<td class="tbl_data_td"><?php echo $det['sales_name']; ?></td>
						<td class="tbl_data_td"><?php echo $det['sales_company']; ?></td>
						<td class="tbl_data_td"><?php echo $det['payment_note']; ?></td>
					</tr>
					<?php	
					
					$total_billing +=  $det['total_billing'];
					$total_tax +=  $det['tax_total'];
					$total_service +=  $det['service_total'];
					$grand_total +=  $det['grand_total'];
					$grand_total_compliment += $det['total_compliment'];
					$grand_sub_total += $det['sub_total'];
					$grand_total_pembulatan += $det['total_pembulatan'];
					$grand_discount_total += $det['discount_total'];
					$grand_discount_billing_total += $det['discount_billing_total'];
					$grand_total_dp += $det['total_dp'];
					$grand_total_sales_fee += $det['total_sales_fee'];
					$no++;
				}
				
				?>
				<tr>
					<td class="tbl_summary_td_first_xright" colspan="<?php echo 3; ?>">TOTAL</td>
					<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($total_billing); ?></td>
					<?php
					if($diskon_sebelum_pajak_service == 1){
						?>
						<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_discount_total); ?></td>
						<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_discount_billing_total); ?></td>
						<?php
					}
					?>
					<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($total_tax); ?></td>
					<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($total_service); ?></td>
					<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_sub_total); ?></td>
					<?php
					if($diskon_sebelum_pajak_service == 0){
						?>
						<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_discount_total); ?></td>
						<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_discount_billing_total); ?></td>
						<?php
					}
					?>
					<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_total_pembulatan); ?></td>
					<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_total_compliment); ?></td>
						<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_total); ?></td>
					<td class="tbl_summary_td_xright">Rp. <?php echo priceFormat($grand_total_sales_fee); ?></td>
					<td class="tbl_summary_td_xright" colspan="3">&nbsp;</td>
				</tr>
				<?php
			}else{
			?>
				<tr>
					<td class="tbl_data_td_first_xcenter" colspan="<?php echo $total_cols; ?>">Data Not Found</td>
				</tr>
			<?php
			}
			
		?>	
		
		<tr>
			<td colspan="<?php echo $total_cols; ?>">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">Printed: <?php echo date("d-m-Y H:i:s");?></td>
			<td colspan="<?php echo $total_cols-7; ?>" class="xcenter">&nbsp;</td>
			<td colspan="2" class="xcenter">
					Prepared by:<br/><br/><br/><br/>
					----------------------------
			</td>
			<td colspan="2" class="xcenter">
				
					Approved by:<br/><br/><br/><br/>
					----------------------------
			</td>
		</tr>
		</tbody>
	</table>
</div>
</body>
</html>