<div id="login-register" class="modal-tab">
    <div class="modal-tab-overlay"></div>
    <div class="modal-tab-wrapper modal-tab-transition">
        <div class="modal-tab-header">
            <button class="modal-tab-close close-button-x">+</button>
        </div>

        <div class="modal-tab-body">
            <div class="modal-tab-content">
                <div class="tab-wrap">
                    <div class="tab-single active" data-toggle-tab-modal="" data-content="0">
                        <h4>Login</h4>
                    </div>
                    <div class="tab-single" data-toggle-tab-modal="" data-content="1">
                        <h4>Register</h4>
                    </div>
                </div>

                <div class="content-box">
                    <div class="tab-content">
                        <div class="tab-content-single active" data-content="0">
                            <div id="login-tab-content">
                                <form id="login" data-toggle="validator" action="https://horse24.com/en/login" method="POST" novalidate="true">
                                    <input type="hidden" name="_token" value="SrIOnf1mhM51lDn3CI10Sf3UrAddEvqwOTfFkXJ2" />
                                    <div class="form-section">
                                        <fieldset class="login-email">
                                            <input class="form-control" type="email" value="" name="email" required="" autofocus="" />
                                            <label class="form-control-placeholder" for="email">Email</label>
                                            <div class="help-block with-errors email-errors text-danger"></div>
                                        </fieldset>

                                        <fieldset class="login-password">
                                            <input class="form-control" type="password" value="" name="password" autocomplete="off" required="" />
                                            <label class="form-control-placeholder" for="password">Password</label>
                                            <div class="help-block with-errors password-errors text-danger"></div>
                                        </fieldset>
                                    </div>

                                    <div class="after-login-fields">
                                        <fieldset>
                                            <div class="form-check form-check-inline">
                                                <label class="checkbox form-check-input transition-on" for="checkbox-1602593964973351">
                                                    <input class="" type="checkbox" data-role="checkbox" name="remember" id="checkbox-1602593964973351" data-role-checkbox="true" /><span class="check"></span><span class="caption"></span>
                                                </label>
                                                <label class="form-check-label" for="inlineCheckbox1" style="min-height: 36px;">Remember me</label>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="bottom-form">
                                        <button>
                                            <span id="login-loading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            Login
                                        </button>
                                    </div>
                                </form>

                                <div class="bottom-options">
                                    <div class="bottom-option-single" data-toggle-tab-modal="" data-content="2">
                                        <h5>Forgot password</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content-single" data-content="1">
                            <form id="register" data-toggle="validator" data-role="validator" action="https://horse24.com/en/registrations" method="POST" novalidate="true" data-role-validator="true">
                                <input type="hidden" name="_token" value="SrIOnf1mhM51lDn3CI10Sf3UrAddEvqwOTfFkXJ2" />
                                <div class="form-section">
                                    <fieldset class="form-group register-email">
                                        <input class="form-control" type="email" value="" name="email" required="" autofocus="" />
                                        <label class="form-control-placeholder" for="email">Email</label>
                                        <div class="help-block with-errors email-errors text-danger"></div>
                                    </fieldset>

                                    <fieldset class="form-group register-password">
                                        <input class="form-control" type="password" value="" name="password" autocomplete="off" required="" />
                                        <label class="form-control-placeholder" for="password">Password</label>
                                        <div class="help-block with-errors password-errors text-danger"></div>
                                    </fieldset>

                                    <fieldset class="register-user_type">
                                        <label class="select form-control required dropdown-toggle" id="select-1602593964978535">
                                            <select name="user_type" class="form-control required" required="" data-validate="required" data-role="select" data-filter="false" data-role-select="true">
                                                <option value="">Select your account type</option>
                                                <option value="Business"> Business </option>
                                                <option value="Private"> Private </option>
                                            </select>
                                            <div class="button-group"></div>
                                            <div class="select-input" name="__select-1602593964978535__">Select your account type</div>
                                            <div class="drop-container" style="display: none;">
                                                <div class="input" style="display: none;">
                                                    <input type="text" data-role="input" placeholder="" style="display: none;" class="" data-role-input="true" />
                                                    <div class="button-group">
                                                        <button class="button input-clear-button" tabindex="-1" type="button"><span class="default-icon-cross"></span></button>
                                                    </div>
                                                </div>
                                                <ul class="d-menu" style="max-height: 200px;">
                                                    <li data-text="Select your account type" data-value="" class="active"><a>Select your account type</a></li>
                                                    <li data-text="Business" data-value="Business"><a>Business</a></li>
                                                    <li data-text="Private" data-value="Private"><a>Private</a></li>
                                                </ul>
                                            </div>
                                        </label>

                                        <label class="form-control-placeholder" for="type">Account Type</label>
                                        <div class="help-block with-errors user_type-errors text-danger"></div>
                                    </fieldset>

                                    <fieldset class="register-accept_terms">
                                        <label class="checkbox form-control required transition-on" for="checkbox-1602593964995863">
                                            <input
                                                class=""
                                                type="checkbox"
                                                data-role="checkbox"
                                                value="accepted"
                                                required=""
                                                name="accept_terms"
                                                data-caption='I confirm that I have read the <a id="term-link" href=_https_/horse24.com/en/term-of-use_.html target="__blank">Terms of Use</a> and agree'
                                                data-validate="required"
                                                id="checkbox-1602593964995863"
                                                data-role-checkbox="true"
                                            />
                                            <span class="check"></span><span class="caption">I confirm that I have read the <a id="term-link" href="_https_/horse24.com/en/term-of-use_.html" target="__blank">Terms of Use</a> and agree</span>
                                        </label>
                                        <div class="help-block with-errors accept_terms-errors text-danger"></div>
                                    </fieldset>
                                </div>

                                <div class="bottom-form">
                                    <button>
                                        <span id="register-loading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-content-single" data-content="2">
                            <form id="forgotpassword" data-toggle="validator" action="https://horse24.com/en/password/email" method="POST" novalidate="true">
                                <input type="hidden" name="_token" value="SrIOnf1mhM51lDn3CI10Sf3UrAddEvqwOTfFkXJ2" />
                                <div class="form-section">
                                    <fieldset>
                                        <input class="form-control" type="email" value="" name="email" required="" />
                                        <label class="form-control-placeholder" for="email">Email</label>
                                    </fieldset>
                                </div>

                                <div class="bottom-form">
                                    <button>Get new password</button>
                                </div>
                            </form>

                            <div class="bottom-options">
                                <div class="bottom-option-single" data-toggle-tab-modal="" data-content="0">
                                    <h5>Back to login</h5>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content-single" data-content="3">
                            <div id="after-register-tab-content">
                                <h4>Your account has been created</h4>
                                <hr />
                                <p>
                                    Before you can have full access to our platform, you need to verify your email address and complete your profile. Please check your inbox or spam folder and click in the link to proceed.
                                </p>

                                <div id="after-registration-wrap" class="hs-popup-wrap inner-block">
                                    <div class="hs-popup has-wizard-new sw-main sw-theme-default">
                                        <ul class="nav nav-tabs step-anchor">
                                            <li data-status="done" class="nav-item active">
                                                <a href="#step-1" class="nav-link">
                                                    <span class="step-number">1</span>
                                                    <small>Register (Basic Access)</small>
                                                </a>
                                            </li>
                                            <li data-status="active" class="nav-item">
                                                <a href="#step-2" class="nav-link">
                                                    <span class="step-number">2</span>
                                                    <small>Verify Email Address</small>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#step-3" class="nav-link">
                                                    <span class="step-number">3</span>
                                                    <small>Complete your Profile</small>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#step-4" class="nav-link">
                                                    <span class="step-number">4</span>
                                                    <small>Full Access Including Bids</small>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <h5 class="text-center">
                                    You can login now but you won't be able to bid and view some lot information before completing those steps.
                                </h5>
                            </div>
                        </div>

                        <div class="tab-content-single" data-content="4">
                            <div id="after-register-tab-content">
                                <h4>Registration not yet completed</h4>
                                <hr />
                                <p>
                                    Before you can get full access to our online auction, we ask you to verify your email address so that you can register completely.
                                </p>

                                <div id="after-registration-wrap" class="hs-popup-wrap inner-block">
                                    <div class="hs-popup has-wizard-new sw-main sw-theme-default">
                                        <ul class="nav nav-tabs step-anchor">
                                            <li data-status="done" class="nav-item active">
                                                <a href="#step-1" class="nav-link">
                                                    <span class="step-number">1</span>
                                                    <small>Register (Basic Access)</small>
                                                </a>
                                            </li>
                                            <li data-status="active" class="nav-item">
                                                <a href="#step-2" class="nav-link">
                                                    <span class="step-number">2</span>
                                                    <small>Verify Email Address</small>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#step-3" class="nav-link">
                                                    <span class="step-number">3</span>
                                                    <small>Complete your Profile</small>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#step-4" class="nav-link">
                                                    <span class="step-number">4</span>
                                                    <small>Full Access Including Bids</small>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <h5 class="text-center">
                                    If you have not received our email to verify your email address, you can request it again here. Please also look in your SPAM folder.
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
