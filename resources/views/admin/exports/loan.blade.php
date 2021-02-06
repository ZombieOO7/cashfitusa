<table>
    <thead>
    <tr>
        <th>Loan Application Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Contact No</th>
        <th>Alternate Contact No</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip Code</th>
        <th>Date of birth</th>
        <th>SSN</th>
        <th>Bank Name</th>
        <th>Type Of Account</th>
        <th>Account Number</th>
        <th>Routing number</th>
        <th>Initial Amount</th>
        <th>Tenure</th>
        <th>Monthly Instalment</th>
        <th>Type Of Loan</th>
        <th>Have you borrowed any loan in past ?</th>
        <th>Have you got a loan pending?</th>
        <th>Do you have any outstanding credit cards payments or medical bills?</th>
        <th>Apply Date</th>
        <th>Apply Time</th>
    </tr>
    </thead>
    <tbody>
     @forelse($userLoanDetail as $loan)
        <tr>
            <td>{{ @$loan->auto_account_number }}</td>
            <td>{{ @$loan->first_name }}</td>
            <td>{{ @$loan->last_name }}</td>
            <td>{{ @$loan->phone1 }}</td>
            <td>{{ @$loan->phone2 }}</td>
            <td>{{ @$loan->address1 }} , {{ @$loan->address2 }}</td>
            <td>{{ @$loan->city }}</td>
            <td>{{ @$loan->state }}</td>
            <td>{{ @$loan->zip_code }}</td>
            <td>{{ @$loan->dob_text }}</td>
            <td>{{ @$loan->ssn }}</td>
            <td>{{ @$loan->bank_name }}</td>
            <td>{{ @$loan->account_type }}</td>
            <td>{{ @$loan->account_number }}</td>
            <td>{{ @$loan->routing_number }}</td>
            <td>{{ @$loan->loan_amount }}</td>
            <td>{{ @$loan->months }}</td>
            <td>{{ @$loan->repayment_amount }}</td>
            <td>{{ @$loan->loan_type }}</td>
            <td>{{ (@$loan->past_loan == 1) ? 'Yes' : 'No' }}</td>
            <td>{{ (@$loan->pending_loan == 1) ? 'Yes' : 'No'  }}</td>
            <td>{{ (@$loan->pending_bill == 1) ? 'Yes' : 'No' }}</td>
            <td>{{ @$loan->proper_created_at_text }}</td>
            <td>{{ @$loan->proper_created_at_time }}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>