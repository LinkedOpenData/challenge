<?php
	require_once( dirname(__FILE__) . '/template/header.php');
	require_once( dirname(__FILE__) . '/template/footer.php');
	
	require_once dirname(__FILE__) . '/util/lod_db.php';
	require_once dirname(__FILE__) . '/util/base.php';
	require_once dirname(__FILE__) . '/util/copyright.php';
	require_once dirname(__FILE__) . '/util/password_manager.php';
	require_once dirname(__FILE__) . '/util/form_checker.php';

	require_once dirname(__FILE__) . '/util/lod_settings.php';

	$cr = Copyright::getInstance();
	$db = LodDb::getInstance();
	$pm = PasswordManager::getInstance();
	$fc = FormChecker::getInstance();
	$pageTitle = "データセットの応募情報を修正する";
	
	if($_POST){
	$errorMessages = array();
		if(isset($_POST['modify'])){
			// val check
			$ret = $fc->notEmpty($_POST["name"]);
			if($ret !== true) $errorMessages["name"] = $ret;
			
			$ret = $fc->notEmpty($_POST["affiliation"]);
			if($ret !== true) $errorMessages["affiliation"] = $ret;
			
			$ret = $fc->email($_POST["email"]);
			if($ret !== true) $errorMessages["email"] = $ret;
			
			$ret = $fc->notEmpty($_POST["dataset-name"]);
			if($ret !== true) $errorMessages["dataset-name"] = $ret;
			
			$ret = $fc->checkLength($_POST["dataset-abstract"], 100);
			if($ret !== true) $errorMessages["dataset-abstract"] = $ret;
		
			$ret = $fc->regex($_POST["related-dataset"].' ', "^\s*(([0-9]{4}-)?d[0-9]{3}\s+)*\s*$");
			if($ret !== true) $errorMessages["related-dataset"] = $ret;
			
			$ret = $fc->regex($_POST["related-idea"].' ', "^\s*(([0-9]{4}-)?i[0-9]{3}\s+)*\s*$");
			if($ret !== true) $errorMessages["related-idea"] = $ret;

			$ret = $fc->regex($_POST["related-application"].' ', "^\s*(([0-9]{4}-)?a[0-9]{3}\s+)*\s*$");
			if($ret !== true) $errorMessages["related-application"] = $ret;	
		
			$ret = $fc->regex($_POST["related-visualization"].' ', "^\s*(([0-9]{4}-)?v[0-9]{3}\s+)*\s*$");
			if($ret !== true) $errorMessages["related-visualization"] = $ret;
			
			$ret = $fc->regex($_POST["related-basetechnology"].' ', "^\s*(([0-9]{4}-)?b[0-9]{3}\s+)*\s*$");
			if($ret !== true) $errorMessages["related-basetechnology"] = $ret;
			
			if(empty($errorMessages)){ // 必須入力項目の検証を行ったので、check_dataset_input.php へ
				require("check_dataset_input.php");
				return;
			}
		} else {
			/* データベースから検索 */
			$item = $db->executeQuery("select * from dataset_2014 where id = ".$_POST['id']);
			if(empty($item) || !$pm->verify($_POST['password'], $item[0]['hashed_password'])){
				// 認証失敗
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: ".BASE_URL."show_status.php?id=d".sprintf("%03d", $_POST['id']));
				exit();
			}
			/* POSTデータへ変換 */
			$_POST["id"] = $item[0]["id"];
			$_POST["name"] = $item[0]["name"];
			$_POST["affiliation"] = $item[0]["affiliation"];
			$_POST["affiliation_anonymous"] = $item[0]["affiliation_anonymous"];
			$_POST["is_student"] = $item[0]["is_student"];
			$_POST["email"] = $item[0]["email"]; 
			$_POST["email_anonymous"] = $item[0]["email_anonymous"];
			$_POST["set_mailinglist"] = $item[0]["set_mailinglist"];

			$_POST["dataset-name"] = $item[0]["dataset_name"];
			$_POST["dataset-url"] = $item[0]["url"];
			$_POST["dataset-abstract"] = $item[0]["abstract"];
			$_POST["dataset-description"] = $item[0]["description"];
			$_POST["dataset-propose"] = $item[0]["request"];

			$_POST["related-dataset"] = $item[0]["related_dataset_ids"];
			$_POST["related-idea"] = $item[0]["related_idea_ids"];
			$_POST["related-application"] = $item[0]["related_application_ids"];
			$_POST["related-visualization"] = $item[0]["related_visualization_ids"];
			$_POST["related-basetechnology"] = $item[0]["related_basetechnology_ids"];
			$_POST["right"] = $item[0]["copyright"];
			$_POST["license"] = $item[0]["license"];
			$_POST["icon_filename"] = $item[0]["icon_filename"];

//			$_POST["password"] = $item[0]["hashed_password"];
		}

	} else {
		// URL直打ち
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".BASE_URL."dataset.html");
		exit();
	}
	
	function outErrMes($key){
		global $errorMessages;
		return (isset($errorMessages[$key]) ? '<div class="error-message">'.$errorMessages[$key].'</div>' : '');
	}
?>
<?php echo get_header($pageTitle); ?>
<div id="contents-form">
<h2>データセットの応募情報を修正する</h2>
<form enctype="multipart/form-data" action="modify_dataset_status.php" method="post">
	<table class="application-form" id="input-form">
		<tr class="info-row">
			<th colspan="2">応募者の情報</th>
		</tr>
		<tr>
			<th>ご氏名*</th>
			<td><input type="text" name="name" value="<?php echo $_POST["name"]; ?>" />
				<?php echo outErrMes("name");?></td>
		</tr>
		<tr>
			<th>ご所属*</th>
			<td><input type="text" name="affiliation" value="<?php echo $_POST["affiliation"]; ?>" />
				<select name="affiliation_anonymous">
					<option value="false"<?php echo (isset($_POST["affiliation_anonymous"]) && !$_POST["affiliation_anonymous"] ? " selected" : "") ?>>ホームページ上に公開する</option>
					<option value="true"<?php echo (isset($_POST["affiliation_anonymous"]) && $_POST["affiliation_anonymous"] ? " selected" : "") ?>>ホームページ上に公開しない</option>
				</select>
				<div class="limit-description">
					学生の方は選択してください（任意）。作品が各賞の他、学生奨励賞の候補にもなります。
					<select name="is_student">
						<option value="false"<?php echo (isset($_POST["is_student"]) && !$_POST["is_student"] ? " selected" : "") ?>>一般</option>
						<option value="true"<?php echo (isset($_POST["is_student"]) && $_POST["is_student"] ? " selected" : "") ?>>学生</option>
					</select>
				</div>
				<?php echo outErrMes("affiliation");?></td>
		</tr>
		<tr>
			<th>e-mailアドレス*</th>
			<td><input type="text" name="email" value="<?php echo $_POST["email"]; ?>" />
				<select name="email_anonymous">
					<option value="false"<?php echo (isset($_POST["email_anonymous"]) && !$_POST["email_anonymous"] ? " selected" : "") ?>>ホームページ上に公開する</option>
					<option value="true"<?php echo (isset($_POST["email_anonymous"]) && $_POST["email_anonymous"] ? " selected" : "") ?>>ホームページ上に公開しない</option>
				</select>
				<?php echo outErrMes("email");?></td>
		</tr>
		<tr>
			<th></th>
			<td>
				<div class="limit-description">
					LODチャレンジのイベント開催等のご案内をお送りしても宜しいでしょうか。
				<select name="set_mailinglist">
					<option value="false"<?php echo (isset($_POST["set_mailinglist"]) && !$_POST["set_mailinglist"] ? " selected" : "") ?>>情報配信を希望しない</option>
					<option value="true"<?php echo (isset($_POST["set_mailinglist"]) && $_POST["set_mailinglist"] ? " selected" : "") ?>>情報配信を希望する</option>
				</select>
			</td>
		</tr>

		<tr class="info-row">
			<th colspan="2">応募するデータセットの情報</th>
		</tr>
		<tr>
			<th>データセットの名称*</th>
			<td><input type="text" name="dataset-name" value="<?php echo $_POST["dataset-name"]; ?>" />
				<?php echo outErrMes("dataset-name");?></td>
		</tr>
		<tr>
			<th>データセットのURL*</th>
			<td><input type="hidden" name="dataset-url" value="<?php echo $_POST["dataset-url"]; ?>" />
				<a href="<?php echo $_POST["dataset-url"]; ?>" target="_blank"><?php echo $_POST["dataset-url"]; ?></a>
				<div class="limit-description">修正できません</div></td>
		</tr>
		<tr>
			<?php require("print_str_length.php"); ?>
			<th>データセットの概略説明(100字以内で記述して下さい)* [<span id="inputlegth"><?php echo mb_strlen($_POST["dataset-abstract"]); ?>文字</span>]</th>
			<td>
				<textarea name="dataset-abstract"  onkeyup="ShowLength(value, 'inputlegth');"><?php echo $_POST["dataset-abstract"]; ?></textarea>
				<?php echo outErrMes("dataset-abstract");?>
			</td>
		</tr>
		<tr>
			<th>データセットの詳細説明(作品詳細について記述して下さい)</th>
			<td>
				<textarea name="dataset-description"><?php echo $_POST["dataset-description"]; ?></textarea>
				<?php echo outErrMes("dataset-description");?>
			</td>
		</tr>

		<tr>
			<th>アプリ提案・希望</th>
			<td>
				<textarea name="dataset-propose"><?php echo $_POST["dataset-propose"]; ?></textarea>
			</td>
		</tr>
		<tr>
			<th>データセットの権利指定</th>
			<td>
				<?php if($_POST["right"]){ ?>
				<input type="hidden" name="right" value="<?php echo $_POST["right"]; ?>" />
				<div class="designate-right">
					<img src="<?php echo $cr->image($_POST["right"]) ?>" />
					<div class="title"><?php echo $cr->title($_POST["right"]) ?></div>
					<div class="description"><?php echo $cr->description($_POST["right"]) ?></div>
				</div>
				<?php } else {
					echo '<input type="hidden" name="right" value="" />';
				} ?>
				<?php if($_POST["creator"]){ ?>
				<div>著作者または製作者 <?php echo $_POST["creator"]; ?></div>
				<input type="hidden" name="creator" value="<?php echo $_POST["creator"]; ?>" />
				<?php } ?>
				<div class="limit-description">修正できません</div>
			</td>
		</tr>

		<tr>
			<th>データセットのアイコン (データセットを表すアイコンがあればファイルを指定下さい)</th>
			<td>
				<img src="<?php echo $_POST["icon_filename"]; ?>" width="<?php echo L_ICON_WIDTH ; ?>" heigth="<?php echo L_ICON_HEIGHT ; ?>" alt="icon">
				<input type="hidden" name="previous_icon_filename"  value="<?php echo $_POST["icon_filename"]; ?>" />
				<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
				修正する場合のアイコン・ファイルの送信: <input type="file" name="dataset-icon" />
			</td>
		</tr>

		<tr class="info-row">
			<th colspan="2">関連する作品の情報　LODチャレンジJapan2014では作品が「つながる」ことを推奨しています</th>
		</tr>
		<tr>
			<th>関連する既に応募されたデータセット</th>
			<td>
				<input type="text" name="related-dataset" value="<?php echo $_POST["related-dataset"]; ?>" />
				<?php echo outErrMes("related-dataset");?>
				<div class="limit-description">dから始まるエントリー番号を入力．2011年度の作品の場合は頭に2011-,2012年度の作品の場合は頭に2012-,2013年度の作品の場合は頭に2013-を入れる．複数ある場合は半角スペースで区切って下さい．(例: d003 2011-d015)</div>
			</td>
		</tr>
		<tr>
			<th>関連する既に応募されたアイデア</th>
			<td>
				<input type="text" name="related-idea" value="<?php echo $_POST["related-idea"]; ?>" />
				<?php echo outErrMes("related-idea");?>
				<div class="limit-description">iから始まるエントリー番号を入力．2011年度の作品の場合は頭に2011-,2012年度の作品の場合は頭に2012-,2013年度の作品の場合は頭に2013-を入れる．複数ある場合は半角スペースで区切って下さい．(例: i003 2011-i015 2012-i015)</div>
			</td>
		</tr>
		<tr>
			<th>関連する既に応募されたアプリケーション作品</th>
			<td>
				<input type="text" name="related-application" value="<?php echo $_POST["related-application"]; ?>" />
				<?php echo outErrMes("related-application");?>
				<div class="limit-description">aから始まるエントリー番号を入力．2011年度の作品の場合は頭に2011-,2012年度の作品の場合は頭に2012-,2013年度の作品の場合は頭に2013-を入れる．複数ある場合は半角スペースで区切って下さい．(例: a003 2011-a015 2012-a015)</div>
			</td>
		</tr>
		<tr>
			<th>関連する既に応募されたビジュアライゼーション作品</th>
			<td>
				<input type="text" name="related-visualization" value="<?php echo $_POST["related-visualization"]; ?>" />
				<?php echo outErrMes("related-visualization");?>
				<div class="limit-description">vから始まるエントリー番号を入力．2012年度の作品の場合は頭に2012-,2013年度の作品の場合は頭に2013-を入れる．複数ある場合は半角スペースで区切って下さい．(例: v003 2012-v015)</div>
			</td>
		</tr>
		<tr>
			<th>関連する既に応募された基盤技術作品</th>
			<td>
				<input type="text" name="related-basetechnology" value="<?php echo $_POST["related-basetechnology"]; ?>" />
				<?php echo outErrMes("related-basetechnology");?>
				<div class="limit-description">bから始まるエントリー番号を入力．2013年度の作品の場合は頭に2013-を入れる．複数ある場合は半角スペースで区切って下さい．(例: b003 2013-b015)</div>
			</td>
		</tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
	<input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
	<input type="hidden" name="modify" value="true">
	<input type="submit" value="確認" />
</form>
</div>
<?php echo get_footer($pageTitle); ?>
