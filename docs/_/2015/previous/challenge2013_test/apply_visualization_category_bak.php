<?php
	require_once( dirname(__FILE__) . '/template/header.php');
	require_once( dirname(__FILE__) . '/template/footer.php');
	
	require_once dirname(__FILE__) . '/util/copyright.php';
	require_once dirname(__FILE__) . '/util/form_checker.php';
	$cr = Copyright::getInstance();
	$fc = FormChecker::getInstance();
	$pageTitle = "ビジュアライゼーション部門に応募する";
	
	$errorMessages = array();
	
	if($_POST){
		// val check
		$ret = $fc->notEmpty($_POST["name"]);
		if($ret !== true) $errorMessages["name"] = $ret;
		
		$ret = $fc->notEmpty($_POST["affiliation"]);
		if($ret !== true) $errorMessages["affiliation"] = $ret;
		
		$ret = $fc->email($_POST["email"]);
		if($ret !== true) $errorMessages["email"] = $ret;
		
		$ret = $fc->confirm($_POST["email"], $_POST["email-confirmation"]);
		if($ret !== true) $errorMessages["email-confirmation"] = $ret;
		
		$ret = $fc->notEmpty($_POST["visualization-name"]);
		if($ret !== true) $errorMessages["visualization-name"] = $ret;
		
		$ret = $fc->notEmpty($_POST["visualization-abstract"]);
		if($ret !== true) $errorMessages["visualization-abstract"] = $ret;
		
		$ret = $fc->regex($_POST["related-dataset"].' ', "^\s*(([0-9]{4}-)?d[0-9]{3}\s+)*\s*$");
		if($ret !== true) $errorMessages["related-dataset"] = $ret;
		
		$ret = $fc->regex($_POST["related-idea"].' ', "^\s*(([0-9]{4}-)?i[0-9]{3}\s+)*\s*$");
		if($ret !== true) $errorMessages["related-idea"] = $ret;
		
		// FileかURLか
		if($_POST["visualization-select"] == 'url'){ // url
			$ret = $fc->notEmpty($_POST["visualization-url"]);
			if($ret !== true) $errorMessages["object"] = $ret;
			
			$ret = $fc->regex($_POST["visualization-url"], "^https?:\/\/");
			if($ret !== true) $errorMessages["object"] = $ret;
		} else { // file
			if(empty($_FILES['visualization-file']['name'])){
				$errorMessages["object"] = "ファイルを指定してください．";
			} 
		}
		
		$ret = $fc->notEmpty($_POST["license"]); // ライセンスの記述を優先
		if($ret === true) {
			unset($_POST["right"]);
		}
		
		if(empty($errorMessages)){
			require("check_visualization_input.php");
			return;
		}
	}
	
	function outErrMes($key){
		global $errorMessages;
		return (isset($errorMessages[$key]) ? '<div class="error-message">'.$errorMessages[$key].'</div>' : '');
	}
	
	$pankuzuList = array(
		array("name" => "HOME", "url" => "index.html"),
		array("name" => "応募する"),
		array("name" => "ビジュアライゼーション部門に応募する")
	);
?>
<?php echo get_header($pageTitle); ?>
<div id="contents-form">
<h2 class="iconVisualS">ビジュアライゼーション部門に応募する</h2>
<form action="apply_visualization_category.php" method="post" enctype="multipart/form-data">
	<div>* がついている項目は入力必須です</div>
	<table class="application-form" id="input-form">
		<tr class="info-row">
			<th colspan="2">応募者の情報</th>
		</tr>
		<tr>
			<th>ご氏名 *</th>
			<td>
				<input type="text" name="name" value="<?php echo $_POST["name"]; ?>" />
				<?php echo outErrMes("name");?>
			</td>
		</tr>
		<tr>
			<th>ご所属 *</th>
			<td><input type="text" name="affiliation" value="<?php echo $_POST["affiliation"]; ?>" />
				<select name="affiliation_anonymous">
					<option value="false"<?php echo (isset($_POST["affiliation_anonymous"]) && $_POST["affiliation_anonymous"] == 'false' ? " selected" : "") ?>>ホームページ上に公開する</option>
					<option value="true"<?php echo (isset($_POST["affiliation_anonymous"]) && $_POST["affiliation_anonymous"] == 'true' ? " selected" : "") ?>>ホームページ上に公開しない</option>
				</select>
				<div class="limit-description">
					学生の方は所属名に続けて「（学生）」と記入ください（任意）。
					記入された場合、作品が各賞の他、学生奨励賞の候補にもなります。
				</div>
				<?php echo outErrMes("affiliation");?>
			</td>
		</tr>
		<tr>
			<th>e-mailアドレス *</th>
			<td><input type="text" name="email" value="<?php echo $_POST["email"]; ?>" />
				<select name="email_anonymous">
					<option value="false"<?php echo (isset($_POST["email_anonymous"]) && $_POST["email_anonymous"] == 'false' ? " selected" : "") ?>>ホームページ上に公開する</option>
					<option value="true"<?php echo (isset($_POST["email_anonymous"]) && $_POST["email_anonymous"] == 'true' ? " selected" : "") ?>>ホームページ上に公開しない</option>
				</select>
				<?php echo outErrMes("email");?>
			</td>
		</tr>
		<tr>
			<th>e-mailアドレス(確認) *</th>
			<td><input type="text" name="email-confirmation" />
				<?php echo outErrMes("email-confirmation");?>
			</td>
		</tr>
		<tr class="info-row">
			<th colspan="2">応募するビジュアライゼーション作品の情報</th>
		</tr>
		<tr>
			<th>ビジュアライゼーション作品の名称 *</th>
			<td><input type="text" name="visualization-name" value="<?php echo $_POST["visualization-name"]; ?>" />
				<?php echo outErrMes("visualization-name");?>
			</td>
		</tr>
		<tr>
			<th>ビジュアライゼーション作品の概略 *</th>
			<td>
				<textarea name="visualization-abstract"><?php echo $_POST["visualization-abstract"]; ?></textarea>
				<?php echo outErrMes("visualization-abstract");?>
			</td>
		</tr>
		<tr>
			<th>関連する既に応募されたデータセット</th>
			<td>
				<input type="text" name="related-dataset" value="<?php echo $_POST["related-dataset"]; ?>" />
				<?php echo outErrMes("related-dataset");?>
				<div class="limit-description">dから始まるエントリー番号を入力．2011年度の作品の場合は頭に2011-を入れる。複数ある場合は半角スペースで区切って下さい．(例: d003 2011-d015)</div>
			</td>
		</tr>
		<tr>
			<th>関連する既に応募されたアイデア</th>
			<td>
				<input type="text" name="related-idea" value="<?php echo $_POST["related-idea"]; ?>" />
				<?php echo outErrMes("related-idea");?>
				<div class="limit-description">iから始まるエントリー番号を入力．2011年度の作品の場合は頭に2011-を入れる。複数ある場合は半角スペースで区切って下さい．(例: i003 2011-i015)</div>
			</td>
		</tr>
		<tr>
			<th>ビジュアライゼーション作品の投稿 *</th>
			<td>
				<input type="radio" name="visualization-select" value="url" <?php echo (isset($_POST["visualization-select"]) && $_POST["visualization-select"] == 'file' ? '' : 'checked'); ?> onclick="document.getElementById('visualization-file-input').disabled = true;document.getElementById('visualization-url-input').disabled = false;"> URL: <input type="text" id="visualization-url-input" name="visualization-url" value="<?php echo $_POST["visualization-url"]; ?>" <?php echo (isset($_POST["visualization-select"]) && $_POST["visualization-select"] == 'file' ? 'disabled' : ''); ?> /> 
				<br>
				<input type="radio" name="visualization-select" value="file" <?php echo (isset($_POST["visualization-select"]) && $_POST["visualization-select"] == 'file' ? 'checked' : ''); ?> onclick="document.getElementById('visualization-file-input').disabled = false;document.getElementById('visualization-url-input').disabled = true;"> ファイルの送信: <input type="file" id="visualization-file-input" name="visualization-file" <?php echo (isset($_POST["visualization-select"]) && $_POST["visualization-select"] == 'file' ? '' : 'disabled'); ?> />
				<?php echo outErrMes("object");?>
			</td>
		</tr>
		<tr>
			<th>ビジュアライゼーション作品の権利指定</th>
			<td>
				<script type="text/javascript">
					$(document).ready(function(){
						imageSelect("cc-select");
					});
				</script>
				<select class="cc-select" name="right">
					<?php 
						foreach(array("public", "by", "by-sa", "by-nd", "by-nc", "by-nc-sa", "by-nc-nd", "copyright") as $cc) {
							echo '<option value="'.$cc.'" data-icon="'.$cr->image($cc).'" data-html-text="'.$cr->title($cc).'"'.
								($cc == (isset($_POST["right"]) ? $_POST["right"] : "") ? " selected" : "").'>'.$cr->title($cc).'</option>';
						}
					?>
				</select>
				<div class="limit-description">クリエイティブ・コモンズ・ライセンスの詳細は<a href="http://creativecommons.jp/licenses/" target="_blank">こちら</a>をご参照ください。</div>
			</td>
		</tr>
	</table>
	<input type="submit" value="確認" />
</form>
</div>
<?php echo get_footer($pageTitle); ?>