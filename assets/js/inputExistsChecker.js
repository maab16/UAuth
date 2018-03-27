$.fn.inputExistsChecker = function(){

	return this.each(function(){

		var interval;
		
		$(this).on('keyup click keydown',function(){

			var self = $(this),
				selfType=self.data('type'),
				selfValue,
				feedback = $('.check-exists-feedback[data-type=' + selfType + ']');

			if (interval===undefined) {

				interval = setInterval(function(){

					if (selfValue !== self.val()) {

						selfValue = self.val();

						//if (selfValue.length) {

							$.ajax({

								url 		: '/entab/App/Lib/exists.php',
								type 		: 'get',
								dataType 	: 'json',
								data 		: {

										type :selfType,
										value:selfValue
								},

								success	: function(data){

									if (data.exists !== undefined) {

										if (data.exists===true) {

											if (selfType=='username') {

												$('.username').removeClass('available').addClass('exists');
												feedback.html('<p class="p-3 mt-2 bg-danger text-white">Sorry!Already Taken.Please Choose Another One.</p>');

											}else if(selfType=='email'){
												$('.email').removeClass('available').addClass('exists');
												feedback.html('<p class="p-3 mt-2 bg-danger text-white">Sorry!Already Taken.Please Choose Another One.</p>');

											}else if (selfType=='password'){

												var passwordData = "";

												if (!selfValue.match(/^.(?=.{6,})(?=.[a-z])(?=.[A-Z])(?=.[\d\W]).*$/)) {

													if (!selfValue.match(/(?=.*[A-Z])/)) {

														$('.password').removeClass('available').addClass('exists');

														passwordData += "<p class='p-3 mt-2 bg-danger text-white'>Password must be contain at least one Capital Letter!</p>";

													}
													if (!selfValue.match(/(?=.*[\d])/)) {

														$('.password').removeClass('available').addClass('exists');

														passwordData += "<p class='p-3 mt-2 bg-danger text-white'>Password must be contain at least one numter!</p>";
													}

													if (!selfValue.match(/(?=.*[a-z])/)) {

														$('.password').removeClass('available').addClass('exists');

														passwordData += "<p class='p-3 mt-2 bg-danger text-white'>Password must be contain at least one small Letter!</p>";
													}
													if (!selfValue.match(/(?=.*[\W])/)) {

														$('.password').removeClass('available').addClass('exists');

														passwordData += "<p class='p-3 mt-2 bg-danger text-white'>Password must be contain at least one special Charecter!</p>";
													}

													if (!selfValue.match(/(?=.{8,})/)) {

														$('.password').removeClass('available').addClass('exists');

														passwordData += "<p class='p-3 mt-2 bg-danger text-white'>PASSWORD MUST BE CONTAIN AT LEAST 8 CHARECTERS</p>";
													}

													feedback.html(passwordData);
												}


												//feedback.text('Password Must be atleast 1 Capital Charecter , 1 letter and 1 numter');

											}else if (selfType=='re_password') {

												$('.re_password').removeClass('available').addClass('exists');

												feedback.html("<p class='p-3 mt-2 bg-danger text-white'>PASSWORD Doesn't match!</p>");

											}

											
										}else if (data.exists===false){

											if (selfType=='username') {

												var userFeedback = "";

												if (selfValue.length<5) {

													$('.username').removeClass('available').addClass('exists');

													userFeedback += '<p class="p-3 mt-2 bg-danger text-white">Username must be Contain Atleast 5 Charecters!</p>';

												}

												if(!selfValue.charAt(0).match(/^[a-zA-Z_]+$/)) {
													$('.username').removeClass('available').addClass('exists');

													userFeedback += '<p class="p-3 mt-2 bg-danger text-white">First charecter only a-z or A-Z or _(underscore)</p>';
												}

												if(!selfValue.match(/^[0-9a-zA-Z_]+$/)){

													$('.username').removeClass('available').addClass('exists');

													userFeedback += '<p class="p-3 mt-2 bg-danger text-white">Username contain only letters, number or underscore</p>';
													
												}

												if(selfValue.length > 5 && selfValue.match(/^[0-9a-zA-Z_]+$/) && selfValue.charAt(0).match(/^[a-zA-Z_]+$/)){

													$('.username').removeClass('exists').addClass('available');

													userFeedback += '<p class="p-3 mt-2 bg-success text-white">That is Available!</p>';

												}

												feedback.html(userFeedback);

											}else if(selfType=='email'){

												var username = $('input[name="username"]').val();
												
												var validaor = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
												
												$('.email').removeClass('available').addClass('exists');
												
												if(selfValue.length<4){
													
													feedback.html("<p class='p-3 mt-2 bg-danger text-white'>Email name must be 4 charecter</p>");
												
												}else if (selfValue == username) {
													
													feedback.html("<p class='p-3 mt-2 bg-danger text-white'>Email name doesn't same username</p>");
												
												}else if(!validaor.test(selfValue)){
													
													feedback.html("<p class='p-3 mt-2 bg-danger text-white'>Email not valid. Must be contain @ and . </p>");
												
												}else{
												
													$('.email').removeClass('exists').addClass('available');
												
													feedback.html('<p class="p-3 mt-2 bg-success text-white">That is Available</p>');	
												}
											
											}else if(selfType == 'password'){

												$('.password').removeClass('exists').addClass('available');

												feedback.html('<p class="p-3 mt-2 bg-success text-white">PASSWORD STRONG.</p>');
												
											}else if (selfType == 're_password') {

												$('.re_password').removeClass('exists').addClass('available');

												feedback.html('<p class="p-3 -2 bg-danger text-white">PASSWORD MATCHED.</p>');

											}else if(selfType == 'tin_number') {

												var tinFeedback = "";

												if(selfValue.length <= 5) {
													$('.tin').removeClass('available').addClass('exists');

													tinFeedback += '<p class="p-3 mt-2 bg-danger text-white">Tin number at least 6 digit</p>';
												}

												if(!selfValue.match(/^[0-9]+$/)){

													$('.tin').removeClass('available').addClass('exists');

													tinFeedback += '<p class="p-3 mt-2 bg-danger text-white">Tin number must be 0-9</p>';
													
												}

												if(selfValue.length > 5 && selfValue.match(/^[0-9]+$/)){
													$('.tin').removeClass('exists').addClass('available');

													tinFeedback += '<p class="p-3 mt-2 bg-success text-white">That is Available!</p>';
												}

												feedback.html(tinFeedback);
											}

											
										}
									}
									
								},
								error	: function(){

									console.log('file not exists');

								}
							});
						//}
					}
				},500);
			}
		});
	});
};