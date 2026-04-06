<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 30px; border-radius: 10px;">
        <h2 style="color: #ff7e3b;">Thank You, {{ $donation->donor_name }}!</h2>
        <p>Your contribution of <strong>₹{{ number_format($donation->amount, 2) }}</strong> to <strong>You're Wonderful Project</strong> was successful.</p>
        
        <p>Your support is invaluable in our mission to provide mental health awareness and direct assistance to those in need.</p>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h3 style="margin-top: 0;">Donation Summary:</h3>
            <p style="margin-bottom: 5px;"><strong>Transaction ID:</strong> {{ $donation->payment_id }}</p>
            <p style="margin-bottom: 5px;"><strong>Order ID:</strong> {{ $donation->order_id }}</p>
            <p style="margin-bottom: 5px;"><strong>Date:</strong> {{ $donation->created_at->format('M d, Y') }}</p>
            <p style="margin-bottom: 5px;"><strong>Amount:</strong> ₹{{ number_format($donation->amount, 2) }}</p>
        </div>

        <p>If you've provided your PAN number, your 80G tax benefit receipt will be processed shortly.</p>

        <p>Warm regards,<br>
        <strong>The You're Wonderful Project Team</strong></p>
    </div>
</body>
</html>
