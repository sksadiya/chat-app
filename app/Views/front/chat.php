<?= $this->extend('layouts/extend') ?>

<?= $this->section('title') ?> Chat <?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- User List Section -->
        <div class="col-3 p-0 chat-user-column">
            <div class="d-flex flex-column h-100">
                <div class="p-3 border-0">
                    <h5 class="text-light">Chats</h5>
                </div>
                <div class="flex-grow-1 overflow-auto">
                    <div class="list-group list-group-flush bg-transparent p-2" id="user-list">
                        <!-- User items will be dynamically added here via AJAX -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Chat Window Section -->
        <div class="col-9 p-0 d-flex flex-column chat-window">
            <?php if ($users): ?>
                <?php $firstUser = reset($users); ?>

                <div class="chat-header p-3 border-bottom d-flex align-items-center">
                    <img src="<?= base_url('images/' . $firstUser->user_image) ?>" class="rounded-circle me-3" alt="User Image" height="40px" width="40px">
                    <div>
                        <h6 class="mb-0 text-light"><?= $firstUser->username ?></h6>
                        <small class="<?= ($firstUser->status == 'Online') ? 'text-success' : 'text-danger' ?> status"><?= $firstUser->status ?></small>
                    </div>
                </div>

                <div class="chat-body flex-grow-1 p-3 overflow-auto">
                    <!-- Chat messages here (will be updated dynamically) -->
                </div>

                <div class="chat-footer p-3 border-top">
                    <div class="input-group justify-content-center align-items-center">
                        <button type="button" class="btn btn-link text-decoration-none bg-dark rounded-circle me-2 emoji-btn" id="emoji-btn">
                            <i class="fa-regular fa-face-smile"></i>
                        </button>
                        <input type="text" class="form-control chat-input me-2" id="chat-input" placeholder="Type a message">
                        <button class="btn rounded-circle send-button"><i class="fa-regular fa-paper-plane"></i></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to fetch all users via AJAX
        function fetchAllUsers() {
            $.ajax({
                url: '<?= site_url('getAllUsers') ?>', // Ensure correct URL path based on your setup
                method: 'GET',
                dataType: 'json',
                success: function(users) {
                    renderUserList(users);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    console.error('AJAX Error - Fetch All Users:', errorMessage);
                    alert('Failed to fetch users. Please try again later.'); // Example of error message handling
                }
            });
        }

        // Function to fetch user by ID via AJAX
        function fetchUserById(userId) {
            $.ajax({
                url: '<?= site_url('getUserById/') ?>' + userId, // Ensure correct URL path based on your setup
                method: 'GET',
                dataType: 'json',
                success: function(user) {
                    // Update chat header with selected user data
                    $('.chat-header img').attr('src', '<?= base_url('images/') ?>' + user.user_image);
                    $('.chat-header h6').text(user.username);
                    var statusElement = $('.chat-header small');
                statusElement.text(user.status);
                statusElement.removeClass('text-danger text-success');
                if (user.status === 'Online') {
                    statusElement.addClass('text-success');
                } else {
                    statusElement.addClass('text-danger');
                }

                    // Clear chat body (for now, until messages are loaded)
                    $('.chat-body').html('');
                    
                    // Remove active class from all .chat-item elements
                    $('.chat-item').removeClass('active');

                    // Add active class to the clicked .chat-item
                    $('.chat-item[data-user-id="' + userId + '"]').addClass('active');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Function to render user list dynamically
        function renderUserList(users) {
            var userList = $('#user-list');
            userList.empty(); // Clear existing list items
            users.forEach(function(user, index) {
                var activeClass = index === 0 ? 'active' : ''; // Add 'active' class to first user item
                var statusClass = user.status === 'Online' ? 'text-success' : 'text-danger';

                var userItem = $('<a href="#" class="list-group-item list-group-item-action p-3 border-0 chat-item ' + activeClass + '" data-user-id="' + user.id + '">' +
                                    '<div class="d-flex align-items-center">' +
                                        '<img src="<?= base_url('images/') ?>' + user.user_image + '" class="rounded-circle me-3" alt="User Image" height="50px" width="50px">' +
                                        '<div>' +
                                            '<h6 class="mb-0 text-light">' + user.username + '</h6>' +
                                            '<small class="' + statusClass + '">' + user.status + '</small>' +
                                        '</div>' +
                                    '</div>' +
                                '</a>');
                userList.append(userItem);

                // Click event handler for dynamically added .chat-item links
                userItem.on('click', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('user-id');
                    fetchUserById(userId);
                });
            });
        }

        // Initial fetch of all users
        fetchAllUsers();
    });
</script>
<?= $this->endSection() ?>
