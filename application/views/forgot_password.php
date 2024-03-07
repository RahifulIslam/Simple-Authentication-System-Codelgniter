<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .forgot-password-container {
            margin-top: -32rem;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .message {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        .message.error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <?php echo form_open('signin/send_reset_link'); ?>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Reset Password</button>
        <?php echo form_close(); ?>
        <!-- Display success or error messages here -->
        <!-- <div class="message">
            <?php if ($this->session->flashdata('success')): ?>
                <?php echo $this->session->flashdata('success'); ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="message error"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
        </div> -->
    </div>
</body>
</html>
