@if($input == 'date')
    <input type="text" class="transactionDate" name="{{@$input}}"  id="datedata{{@$id}}" value="{{@$transaction->proper_date}}" onchange="saveData(event,'{{@$input}}','{{@$id}}')" onblur="saveData(event,'{{@$input}}','{{@$id}}')">
    <span style="display:none">{{@$transaction->proper_date}}</span>
@else
    <input type="text" name="{{@$input}}"  id="data{{@$id}}" value="{{@$transaction->amount}}" onblur="saveData(event,'{{@$input}}','{{@$id}}')">
    <span style="display:none">{{@$transaction->proper_amount}}</span>
@endif