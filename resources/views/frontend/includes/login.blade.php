<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModal" aria-hidden="true">
    <button type="button" class="close float-close-pro noselect" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header-pro">
                <h2>Sign in</h2>
				<div style="margin-top: 8px;" id="login-reason"></div>
            </div>
            <div class="modal-body-pro social-login-modal-body-pro">

                <div class="registration-login-container">

                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            @include('frontend.auth.includes.socialite')
                        </div>
                    </div><!--col-->
                </div><!--row-->

                    {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}

                        <div class="form-group">
                        {{ html()->text('username')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.username'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                        </div>
                        <div class="form-group">
                        {{ html()->password('password')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.password'))
                                    ->required() }}
                        </div>
                        <div class="container-fluid">
                            <div class="row no-gutters">
                            <div class="col checkbox-remember-pro">{{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}</div>
                            <div class="col forgot-your-password"><a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a></div>
                        </div>
                    </div><!-- close .container-fluid -->
                    <div class="form-group aligncenter">
                        {{ form_submit(__('labels.frontend.auth.login_button')) }}
                    </div>

                    <div class="aligncenter"><a class="not-a-member-pro" href="{{ route('frontend.auth.register') }}">Don't have account? <span>Signup</span></a></div>

                    {{ html()->form()->close() }}


                </div><!-- close .registration-login-container -->

            </div><!-- close .modal-body -->

        </div><!-- close .modal-content -->
    </div><!-- close .modal-dialog -->
</div><!-- close .modal -->
