<!-- resources/views/emails/monthly-report.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Monthly Expense Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #f4f7fa;
            color: #1f2937;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 32px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .header {
            background: linear-gradient(135deg, #4a90e2 0%, #6b48ff 100%);
            padding: 40px 32px;
            text-align: center;
            color: #fff;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 32px;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .intro {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 40px;
        }

        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 48px 0;
        }

        .cta-section {
            text-align: center;
            margin-bottom: 16px;
        }

        .cta {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .cta-button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #3b82f6;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            letter-spacing: 0.025em;
        }

        .cta-button:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.25);
        }

        .footer {
            background: #f8fafc;
            padding: 32px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
        }

        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Monthly Expense Report</h1>
        <div class="subtitle">{{ \Carbon\Carbon::now()->subMonth()->format('F Y') }}</div>
    </div>

    <div class="content">
        <p class="greeting">Hello {{ $user->name ?? 'Friend' }}! 👋</p>
        <p class="intro">Here's your comprehensive monthly expense breakdown. We've organized everything to give you clear insights into your financial activity.</p>

        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 40px;">
            <tr>
                <td align="center" style="padding: 10px;">
                    <table cellpadding="0" cellspacing="0" style="background: #4a90e2; border-radius: 12px; color: #ffffff; padding: 20px; width: 100%;">
                        <tr><td align="center" style="font-size: 13px; text-transform: uppercase;">Total Spent</td></tr>
                        <tr><td align="center" style="font-size: 22px; font-weight: bold;">RS. {{ number_format($summary['total_spent'] ?? 0, 2) }}</td></tr>
                    </table>
                </td>
                <td align="center" style="padding: 10px;">
                    <table cellpadding="0" cellspacing="0" style="background: #fee2e2; border-radius: 12px; color: #b91c1c; padding: 20px; width: 100%;">
                        <tr><td align="center" style="font-size: 13px; text-transform: uppercase;">You Owe</td></tr>
                        <tr><td align="center" style="font-size: 22px; font-weight: bold;">RS. {{ number_format($summary['total_owed'] ?? 0, 2) }}</td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 10px;">
                    <table cellpadding="0" cellspacing="0" style="background: #d1fae5; border-radius: 12px; color: #047857; padding: 20px; width: 100%;">
                        <tr><td align="center" style="font-size: 13px; text-transform: uppercase;">You're Owed</td></tr>
                        <tr><td align="center" style="font-size: 22px; font-weight: bold;">RS. {{ number_format($summary['total_receivable'] ?? 0, 2) }}</td></tr>
                    </table>
                </td>
                <td align="center" style="padding: 10px;">
                    <table cellpadding="0" cellspacing="0" style="background: #ede9fe; border-radius: 12px; color: #6b21a8; padding: 20px; width: 100%;">
                        <tr><td align="center" style="font-size: 13px; text-transform: uppercase;">Net Balance</td></tr>
                        <tr>
                            <td align="center" style="font-size: 22px; font-weight: bold;">
                                RS. {{ number_format($summary['net_balance'] ?? 0, 2) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="section-divider"></div>

        <div class="net-balances" style="margin-bottom: 48px;">
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 20px; color: #1f2937;">💰 Net Balances ({{ \Carbon\Carbon::now()->subMonth()->format('F Y') }})</h2>

            <p style="font-size: 14px; color: #6b7280; margin-bottom: 12px;">
                <strong>Green</strong> = they owe you, <strong>Red</strong> = you owe them.
            </p>

            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-size: 14px; color: #374151;">
                <thead>
                <tr style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #ffffff;">
                    <th style="padding: 12px; text-align: left; font-weight: 600; border-top-left-radius: 12px;">👤 Person</th>
                    <th style="padding: 12px; text-align: right; font-weight: 600;">💸 You Owe</th>
                    <th style="padding: 12px; text-align: right; font-weight: 600;">💰 Owes You</th>
                    <th style="padding: 12px; text-align: right; font-weight: 600; border-top-right-radius: 12px;">⚖️ Net Balance</th>
                </tr>
                </thead>
                <tbody>
                @foreach($balanceDetails as $person => $data)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 12px; font-weight: 600;">{{ $person }}</td>
                        <td style="padding: 12px; text-align: right;">
                            {{ $data['you_owe'] > 0 ? 'RS. ' . number_format($data['you_owe'], 2) : '-' }}
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            {{ $data['owes_you'] > 0 ? 'RS. ' . number_format($data['owes_you'], 2) : '-' }}
                        </td>
                        <td style="padding: 12px; text-align: right; font-weight: 700; color: {{ $data['net_balance'] > 0 ? '#10b981' : ($data['net_balance'] < 0 ? '#dc2626' : '#6b7280') }};">
                            @if($data['net_balance'] > 0)
                                🟢 You will receive RS. {{ number_format($data['net_balance'], 2) }}
                            @elseif($data['net_balance'] < 0)
                                🔴 You need to pay RS. {{ number_format(abs($data['net_balance']), 2) }}
                            @else
                                ✅ All settled
                            @endif
                        </td>
                    </tr>
                @endforeach

                @if(empty($balanceDetails))
                    <tr>
                        <td colspan="4" style="text-align: center; color: #6b7280; padding: 24px;">
                            No financial interactions this month! 🎉
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="cta-section">
            <p class="cta">Ready to dive deeper into your financial insights?</p>
            <a href="{{ url('/dashboard') }}" class="cta-button">View Full Report</a>
        </div>
    </div>

    <div class="footer">
        <p><strong>Expense Tracker</strong> © {{ \Carbon\Carbon::now()->year }}. Made with care for your financial wellness.</p>
        <p>Questions or feedback? Contact us at <a href="mailto:support@expensetracker.com">support@programmersols.com</a></p>
    </div>
</div>
</body>
</html>
