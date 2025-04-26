<!-- resources/views/emails/activate.blade.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Kích hoạt tài khoản</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <tr>
                        <td style="background-color: #4CAF50; padding: 20px; text-align: center;">
                            <h1 style="color: white; margin: 0;">Kích hoạt tài khoản</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px;">Xin chào <strong>{{ $data['name'] }}</strong>,</p>
                            <p style="font-size: 16px;">Cảm ơn bạn đã đăng ký tài khoản. Để hoàn tất quá trình đăng ký, vui lòng nhấn vào nút bên dưới để kích hoạt tài khoản:</p>
                            <div style="text-align: center; margin: 30px 0;">
                                <a href="{{ $data['link'] }}" style="background-color: #4CAF50; color: white; text-decoration: none; padding: 12px 24px; border-radius: 4px; display: inline-block; font-weight: bold;">
                                    Kích hoạt tài khoản
                                </a>
                            </div>
                            <p style="font-size: 14px; color: #777;">Nếu bạn không tạo tài khoản này, bạn có thể bỏ qua email này.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f0f0f0; padding: 20px; text-align: center; font-size: 12px; color: #888;">
                            &copy; {{ date('Y') }} Danaer. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
