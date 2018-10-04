{extends file="layout.tpl"} {block name="stylesheets"}
<link rel="stylesheet" href="assets/css/contact.css"> {/block} {block name="body"}


<main>
    <div id="contact-page" class="container">
        {if !Authentication::admin()}
        <h1>Contact form</h1>
        {if sizeof($errors) > 0}
        <ul class="formErrors">
            {foreach from=$errors item=error}
            <li>{$error}</li>
            {/foreach}
        </ul>
        {/if}
        <div id="contact-form" class="container">
            <form action="contact.php" method="POST" enctype="multipart/form-data" required="required">
                <div class="all-form-groups">
                    {if !Authentication::user()}
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-company-name">Company Name</label>
                            <input type="text" id="register-company-name" name="company-name" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-company-no">Company Registration Number</label>
                            <input type="text" id="register-company-no" name="company-no" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-full-name">Full Name</label>
                            <input type="text" id="register-full-name" name="full-name" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-telephone-number">Telephone Number</label>
                            <input type="text" id="register-telephone-number" name="telephone-number" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-email-address">Email Address</label>
                            <input type="email" id="register-email-address" name="email-address" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-password">Password</label>
                            <input type="text" id="register-password" name="password" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-password-confirmation">Confirm Password</label>
                            <input type="text" id="register-password-confirmation" name="password-confirmation" class="form-control" required="required">
                        </div>
                    </div>
                    {/if}
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="register-rfp">Request For Proposal (*.pdf)</label>
                            <input type="file" id="register-rfp" name="rfp" accept="application/pdf" required="required">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="register-notes">Description Notes</label>
                            <textarea id="register-notes" name="notes" class="form-control" rows="3" required="required"></textarea>
                        </div>
                    </div>

                    {if !Authentication::user()}
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <button type="submit" name="submit" class="btn btn-primary">Register User</button> {else}
                        <button type="submit" name="submit" class="btn btn-primary">Register RFP</button>
                    </div>
                    {/if}
                </div>
            </form>
        </div>
        {/if}
        <hr> {if Authentication::admin()}
        <div id="admin-contact">
            <div id="admin-rfps">
                <h1>RFPs</h1>
                <hr> {foreach from=$RFPs item=row}
                <div class="row">
                    {foreach from=$row item=rfp}
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 rfp">
                        <div class="rfp-inner row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 rfp-id">
                                <p><span class="bold">ID:</span> {$rfp->id}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 rfp-creation">
                                <p>Created on {$rfp->creation}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 rfp-owner-name">
                                <p><span class="bold">Contact:</span> {$rfp->owner->name}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 rfp-owner-orgname">
                                <p><span class="bold">Organization:</span> {$rfp->owner->orgName}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 rfp-notes">
                                <p><span class="bold">RFP Notes:</span></p>
                                <p>
                                    {$rfp->notes}
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <a href="rfp.php?id={$rfp->id}&amp;mode=download"><button type="button" class="btn btn-large btn-block btn-primary">Download RFP PDF</button>
								</a>
                                <a href="rfp.php?id={$rfp->id}&amp;mode=view"><button type="button" class="btn btn-large btn-block btn-primary">View RFP PDF</button>
								</a>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
                {/foreach}
            </div>

            <div id="user-handler">
                <h1>Sign up request</h1>
                <hr>
                <div class="row">

                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>Name:</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>Email:</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>Requested on:</p>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                    </div>

                </div>
                <div class="row user-request">
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>Jacob JavaScript</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>jacob@bajsink.com</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>2018-09-21</p>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="col-xs-2 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-success">Y</button>
                        </div>
                        <div class="col-xs-2 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-danger">N</button>
                        </div>
                    </div>
                </div>
                <div class="row user-request">
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>Jacob JavaScript</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>jacob@bajsink.com</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>2018-09-21</p>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="col-xs-2 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-success">Y</button>
                        </div>
                        <div class="col-xs-2 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-danger">N</button>
                        </div>
                    </div>
                </div>
                <div class="row user-request">
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>Jacob JavaScript</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>jacob@bajsink.com</p>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <p>2018-09-21</p>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="col-xs-2 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-success">Y</button>
                        </div>
                        <div class="col-xs-2 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-danger">N</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {/if}
    </div>

</main>
{/block}