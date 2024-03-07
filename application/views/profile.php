<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* Optional margin */
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            margin-bottom: 10px;
        }

        form {
            text-align: center;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .logout-container {
            position: absolute;
            /* Set the logout form position to absolute */
            top: 3rem;
            /* Position from the top */
            right: 4rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome
            <?php echo $user_data->FirstName; ?>
        </h1>
        <p>Id:
            <?php echo $user_data->id; ?>
        </p>
        <p>First Name:
            <?php echo $user_data->FirstName; ?>
        </p>
        <p>Last Name:
            <?php echo $user_data->LastName; ?>
        </p>
        <p>Email:
            <?php echo $user_data->Email; ?>
        </p>
        <p>Posting Date:
            <?php echo $user_data->PostingDate; ?>
        </p>
        <form action="<?php echo base_url('profile/change_password'); ?>" method="post">
            <button type="submit" name="change_password">Change Password</button>
        </form>
    </div>
    <!-- Logout button outside the profile box -->
    <div class="logout-container">
        <form action="<?php echo base_url('logout'); ?>" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>

</html>