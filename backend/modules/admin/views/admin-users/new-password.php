<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Password: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
				<?= Html::a('<i class="fa-th-list"></i><span> Manage Admin Users</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                                <div class="panel-body">
                                        <div class="employee-create">
						<?php
						$form = ActiveForm::begin(
								[
								    'id' => 'change-password',
								    'method' => 'post',
								    'options' => [
									'class' => 'login-form fade-in-effect'
								    ]
								]
						);
						?>

                                                <div class="row">
                                                        <div class = "form-group col-md-3">
                                                                <div class = "form-group field-adminusers-password" style="width: 100%">
                                                                        <label style = "font-weight:bold;">Enter old Password:</label>
                                                                        <input type = "password" id = "old-password" class = "form-control" name = "old-password" autofocus = "false" required>
                                                                        <p class = "help-block help-block-error"></p>
                                                                </div>

                                                        </div>

                                                        <div class = "form-group col-md-3">
                                                                <div class = "form-group field-adminusers-newpassword" style="width: 100%">
                                                                        <label style = "font-weight:bold;">Enter new Password:</label>
                                                                        <input type = "password" id = "new-password" class = "form-control" name = "new-password" autofocus = "false" required>
                                                                        <p class = "help-block help-block-error"></p>
                                                                </div>

                                                        </div>
                                                        <div class = "form-group col-md-3">
                                                                <div class = "form-group field-adminusers-cnfrmpassword" style="width: 100%">
                                                                        <label style = "font-weight:bold;">Confirm Password:</label>
                                                                        <input type = "password" id = "confirm-password" class = "form-control" name = "confirm-password" autofocus = "false" required>
                                                                        <p class = "help-block help-block-error"></p>
                                                                </div>

                                                        </div>
							<input type = "hidden" id = "oold_password" class = "form-control" value="<?= Yii::$app->user->identity->password ?>">
                                                </div>

                                                <div class = "form-group">
                                                        <button type = "submit" class = "btn btn-primary" id="submit_form">Submit</button>
                                                </div>
						<?php ActiveForm::end(); ?>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
<script>
	$("document").ready(function () {
		$("#submit_form").click(function () {
			submitform();

		});

		$("#old-password").blur(function () {
			var old_password = $(this).val();
			var password = $('#oold_password').val();
			CheckOldPassword(old_password, password);
			//showLoader();

		});
		$('#confirm-password').on('keyup', function () {
			CheckConfirmPasswordMatch();
		});

		function submitform() {
			if (($(".field-adminusers-cnfrmpassword p").text() !== "") || ($(".field-adminusers-password p").text() !== "")) {
				$("form").submit(function (e) {
					e.preventDefault();
				});
			} else {
				$('form').unbind('submit').submit();
			}
		}
		function CheckConfirmPasswordMatch() {

			if (($("#confirm-password ").val()) !== ($("#new-password ").val())) {
				$(".field-adminusers-cnfrmpassword ").addClass('has-error');
				if ($(".field-adminusers-cnfrmpassword p").text() === "") {
					$(".field-adminusers-cnfrmpassword p").append("Password Mismatch");
				}

			} else {
				$(".field-adminusers-cnfrmpassword").removeClass('has-error');
				$(".field-adminusers-cnfrmpassword p").empty("Password Mismatch");
			}



		}
		function CheckOldPassword(old_password, password) {
			//showLoader();
			$.ajax({
				type: 'POST',
				cache: false,
				data: {old_password: old_password, password: password},
				url: homeUrl + 'admin/admin-users/check-old-password',
				success: function (data) {

					if (data == 0) {

						$(".field-adminusers-password").addClass('has-error');
						if ($(".field-adminusers-password p").text() === "") {
							$(".field-adminusers-password p").append("Incorrect old password");
						}
					} else {
						$(".field-adminusers-password").removeClass('has-error');
						$(".field-adminusers-password p").empty("Incorrect old password");
					}
					//hideLoader();
				}
			});
		}
	});
</script>