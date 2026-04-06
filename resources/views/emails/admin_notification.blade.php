<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Donation Received</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 40px; border-radius: 12px; background: #fff;">
        <h2 style="color: #ff7e3b; margin-top: 0;">New donation received!</h2>
        <p>A new contribution has been successfully processed via Razorpay.</p>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee; width: 40%;"><strong>Donor Name:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $donation->donor_name }}</td></tr>
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee;"><strong>Email:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $donation->donor_email }}</td></tr>
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee;"><strong>Mobile:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $donation->donor_mobile }}</td></tr>
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee;"><strong>Amount:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;">₹{{ number_format($donation->amount, 2) }}</td></tr>
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee;"><strong>PAN:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $donation->donor_pan ?? 'N/A' }}</td></tr>
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee;"><strong>Address:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $donation->donor_address ?? 'N/A' }}</td></tr>
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee;"><strong>Payment ID:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;"><code style="background: #f4f4f4; padding: 3px 6px; border-radius: 4px;">{{ $donation->payment_id }}</code></td></tr>
            <tr><td style="padding: 10px; border-bottom: 1px solid #eee;"><strong>Referred By:</strong></td><td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $donation->referred_by ?? 'N/A' }}</td></tr>
        </table>

        <div style="margin-top: 40px; text-align: center;">
            <a href="{{ route('admin.donations.index') }}" style="background: #0f172a; color: #fff; padding: 15px 30px; border-radius: 8px; text-decoration: none; font-weight: 700;">View in Admin Panel</a>
        </div>

        <p style="margin-top: 40px; color: #777; font-size: 0.85rem;">This is an automated notification from your website's donation system.</p>
    </div>
</body>
</html>
