<!DOCTYPE html>
<html>
<head>
    <title>Temporary Password - Incerebrum</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.8; background-color: #f4f4f4; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); text-align: center;">
        <h2 style="color: #007bff;">Temporary Password</h2>

        <p style="color: #333;">Dear <strong>{{ $user->name }}</strong>,</p>

        <p style="color: #333;">
            You recently requested to reset your password for your Incerebrum account. Use the temporary password below to log in:
        </p>

        <div style="background: #eef4ff; padding: 15px; border-left: 5px solid #0056b3; font-size: 20px; font-weight: bold; text-align: center; color: #333; border-radius: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); display: inline-block; margin: 10px auto;">
            🔐 Temporary Password: <br>
            <span style="color: #0056b3; display: block; font-size: 24px; margin-top: 5px;">{{ $tempPassword }}</span>
        </div>

        <p style="margin-top: 20px; color: #333;">
            Please log in using this password and change it immediately to ensure your account remains secure.
        </p>

        <!-- <p style="color: #333;">
            If you didn’t request a password reset, you can safely ignore this email. Need help?  
            <a href="mailto:support@incerebrum.com" style="color: #007bff !important; text-decoration: none;">Contact our support team</a>.
        </p> -->

        <p style="margin-top: 30px; font-size: 14px; color: #666;">
            Best regards,<br><strong>The Incerebrum Team</strong>
        </p>
    </div>
</body>
</html>
