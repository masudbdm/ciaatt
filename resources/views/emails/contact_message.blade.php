<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:30px 0;">
        <tr>
            <td align="center">

                <!-- Main Card -->
                <table width="600" cellpadding="0" cellspacing="0"
                       style="background:#ffffff; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.08); overflow:hidden;">

                    <!-- Header -->
                    <tr>
    <td style="background:#0f2a44; padding:22px 30px;">
        <h2 style="margin:0; color:#ffffff; font-size:20px; font-weight:600; letter-spacing:0.3px;">
            📩 New Contact Message
        </h2>
    </td>
</tr>


                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#374151; font-size:14px; line-height:1.6;">

                            <p style="margin:0 0 12px;">
                                <strong>Name:</strong><br>
                                {{ $mailData['name'] }}
                            </p>

                            <p style="margin:0 0 12px;">
                                <strong>Email:</strong><br>
                                <a href="mailto:{{ $mailData['email'] }}" style="color:#2563eb; text-decoration:none;">
                                    {{ $mailData['email'] }}
                                </a>
                            </p>

                            <p style="margin:20px 0 6px;">
                                <strong>Message:</strong>
                            </p>

                            <div style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:6px; padding:15px;">
                                {{ $mailData['message'] }}
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb; padding:15px 30px; text-align:center; font-size:12px; color:#6b7280;">
                            This message was sent from the website contact form.<br>
                            © {{ date('Y') }} CIAATT
                        </td>
                    </tr>

                </table>
                <!-- End Main Card -->

            </td>
        </tr>
    </table>

</body>
</html>
