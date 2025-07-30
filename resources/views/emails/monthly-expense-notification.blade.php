<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Monthly Expense Report 😊</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f4f7fa;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 650px;
            margin: 40px auto;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #4a90e2, #9013fe);
            padding: 20px;
            text-align: center;
            color: #fff;
        }
        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #555;
            margin-bottom: 15px;
        }
        .intro {
            font-size: 15px;
            color: #666;
            margin-bottom: 25px;
        }
        .card {
            background: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #4a90e2;
        }
        .card h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .card h3::before {
            content: "🛍️";
            margin-right: 8px;
        }
        .card p {
            font-size: 22px;
            color: #e74c3c;
            font-weight: 600;
        }
        .debts-section h2 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .debts-section h2::before {
            content: "💸";
            margin-right: 8px;
        }
        .debts-note {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th {
            background: #4a90e2;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #34495e;
        }
        td.amount {
            text-align: right;
            color: #e74c3c;
            font-weight: 500;
        }
        .cta {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        .cta-button {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(135deg, #4a90e2, #9013fe);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: background 0.3s;
        }
        .cta-button:hover {
            background: linear-gradient(135deg, #357abd, #6b48ff);
            color: #fff;
        }
        .footer {
            background: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
        }
        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }
        @media (max-width: 650px) {
            .container {
                margin: 20px;
                border-radius: 10px;
            }
            .header h1 {
                font-size: 22px;
            }
            .content {
                padding: 20px;
            }
            .card p {
                font-size: 18px;
            }
            th, td {
                font-size: 12px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Monthly Expense Report 😊</h1>
        </div>
        <div class="content">
            <p class="greeting">Hello {{ $user->name ?? 'Friend' }}! 👋</p>
            <p class="intro">Here's your monthly expense report for {{ \Carbon\Carbon::now()->format('F Y') }}! We've crunched the numbers for you. 📊</p>

            <!-- Top Expense Category -->
            <div class="card">
                <h3>You Spent Most On</h3>
                <p>{{ $top_category['name'] ?? 'Miscellaneous' }}: RS. {{ number_format($top_category['total'] ?? 0, 2) }}</p>
            </div>

            <!-- Debts Owed -->
            @if(!empty($debts_owed))
                <div class="debts-section">
                    <h2>Who You Owe</h2>
                    <p class="debts-note">Below are the details of what you owe to others. Let's settle up soon! 😄</p>
                    <table>
                        <thead>
                            <tr>
                                <th>📅 Date</th>
                                <th>👤 Person</th>
                                <th>📝 Description</th>
                                <th>💰 Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($debts_owed as $person => $debts)
                                @foreach ($debts as $debt)
                                    <tr>
                                        <td>{{ $debt['expense_date'] }}</td>
                                        <td>{{ $person }}</td>
                                        <td>{{ $debt['expense_description'] }}</td>
                                        <td class="amount">RS. {{ number_format($debt['amount'], 2) }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="debts-note">Woo-hoo! You don't owe anyone anything this month! 🎉</p>
            @endif

            <!-- Call to Action -->
            <p class="cta">Want to dive into the details? Check out your full report here! 👇</p>
            <a href="{{ url('/dashboard') }}" class="cta-button">View Full Report 🚀</a>
        </div>
        <div class="footer">
            <p>Expense Tracker © {{ \Carbon\Carbon::now()->year }}. Made with ❤️.</p>
            <p>Questions? Reach out at <a href="mailto:support@expensetracker.com">support@expensetracker.com</a> 😊</p>
        </div>
    </div>
</body>
</html>
