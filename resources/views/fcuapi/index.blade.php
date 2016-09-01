@extends('app')

@section('title', 'FCU API')

@section('css')
    <style>
        .key {
            color: red;
            font-weight: bold;
        }

        .value {
            color: blue;
            font-weight: bold;
        }

        .ui.ribbon.label {
            margin-bottom: 1em;
        }

        pre {
            display: block;
            padding: 9px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            word-break: break-all;
            word-wrap: break-word;
            color: #333;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        pre code {
            padding: 0;
            font-size: inherit;
            color: inherit;
            white-space: pre-wrap;
            background-color: transparent;
            border-radius: 0;
        }
    </style>
@endsection

@section('content')
    <h1>FCU API</h1>
    <div class="ui segments">
        <div class="ui segment">
            <h2>GetStuInfo - 透過NID取得資料</h2>

            <div class="ui blue ribbon label">請求</div>
            <br/>
            網址：{{ route('fcuapi.getStuInfo') }}?<span class="key">client_id</span>=<span
                class="value">xxxxx</span>&<span class="key">id</span>=<span class="value">D05xxxxx</span>
            <div class="ui divided selection list">
                <div class="item">
                    <div class="ui red horizontal label">client_id</div>
                    數字，用於驗證請求端
                </div>
                <div class="item">
                    <div class="ui red horizontal label">id</div>
                    字串，欲查詢的NID，開頭字母須大寫
                </div>
            </div>

            <div class="ui blue ribbon label">回應</div>
            <br/>
            Status Code: 200<br/>
            Content-Type: application/json; charset=utf-8<br/>
            <div class="ui two column grid">
                <div class="column">
                    <h3>成功找到該NID的資料</h3>
                    <pre><code>{
  "UserInfo": [
    {
      "status": "1",
      "message": "逢甲本學期在校生",
      "stu_id": "D0512345",
      "stu_name": "小黑帽",
      "stu_class": "資訊工程學系一年級甲班",
      "unit_name": "資訊工程學系",
      "dept_name": "資電學院",
      "in_year": 105.0,
      "stu_sex": "M"
    }
  ]
}
</code></pre>
                    <div class="ui divided selection list">
                        <div class="item">
                            <div class="ui red horizontal label">status</div>
                            是否為逢甲本學期在校生，資料為1、0<br/>
                            1=>逢甲大學本學期在校生<br/>
                            0=>非逢甲大學本學期在校生
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">message</div>
                            回傳訊息，查看詳細的狀態
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">stu_id</div>
                            NID
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">stu_name</div>
                            姓名
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">stu_class</div>
                            班級全稱
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">unit_name</div>
                            科系
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">dept_name</div>
                            學院
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">in_year</div>
                            入學年度
                        </div>
                        <div class="item">
                            <div class="ui red horizontal label">stu_sex</div>
                            性別
                        </div>
                    </div>
                </div>
                <div class="column">
                    <h3>找不到該NID的資料</h3>
                    <pre><code>{
  "UserInfo": [
    {
      "status": "0",
      "message": "非逢甲本學期在校生",
      "stu_id": "",
      "stu_name": "",
      "stu_class": "",
      "unit_name": "",
      "dept_name": "",
      "in_year": 0,
      "stu_sex": ""
    }
  ]
}</code></pre>
                    <h3>id參數為空</h3>
                    <pre><code>{
  "Message": "發生錯誤。"
}</code></pre>
                    <h3>缺少id參數</h3>
                    <pre><code>{
  "UserInfo": [
    ""
  ]
}</code></pre>
                </div>
            </div>
        </div>
    </div>
@endsection
