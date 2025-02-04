<style>
    .welcome {
        margin: 0;
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: #333;
    }
    /* memo一覧のコンテナは縦に並べる */
    .memos {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 30px;
    }
    /* 各memoは横いっぱい利用、内部は横並びでタイトルと更新日時を表示 */
    .memo {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.2s ease;
        text-decoration: none;
        color: inherit;
    }
    .memo:hover {
        background-color: #f0f0f0;
    }
    .memo h3 {
        margin: 0;
        font-size: 18px;
        color: #1a1a1a;
        flex: 1;
    }
    .memo p {
        margin: 0;
        font-size: 14px;
        color: #555;
        /* 内容が長くても1行で表示（テキストがあふれた場合は省略） */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    /* 画面幅が狭い場合は縦並びに切り替え */
    @media (max-width: 600px) {
        .memo {
            flex-direction: column;
            align-items: flex-start;
        }
        .memo p {
            white-space: normal;
        }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.min.js"></script>

<div>
    <h1 class="welcome"><?php echo $username; ?>さん､ようこそ</h1>
    <div class="memos" data-bind="foreach: memos">
        <a class="memo" data-bind="attr: { href: '/edit/' + memo_id }">
            <h3 data-bind="text: title"></h3>
            <p>最終更新: <span data-bind="text: updated_at"></span></p>
        </a>
    </div>
    <script src="/assets/js/home.js"></script>
</div>