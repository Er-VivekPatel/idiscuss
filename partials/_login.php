<!-- loginModal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Login iDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/Forum/partials/_loginhandler.php" method="POST" >
                <div class="modal-body">
                    <!-- login form  -->

                    <div class="mb-3">
                        <label for="login_mail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="login_mail"  aria-describedby="emailHelp" name="login_mail" >
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="login_pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login_pass" name="login_pass">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </form>
            <!-- login form end -->
        </div>
    </div>
</div>