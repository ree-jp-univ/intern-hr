<style>
    .welcome {
        margin: 0;
        text-align: center;
    }

    /* ヘッダー部分 */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 30px;
        margin-top: 20px;
    }

    .content-title {
        font-size: 20px;
        font-weight: bold;
    }

    /* memo一覧のコンテナは縦に並べる */
    .memos {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 30px;
    }

    /* memo の本文部分 */
    .memo {
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.2s ease;
    }

    .memo:hover {
        background-color: #F1F1EF;
    }

    .memo h3 {
        color: #373530;
        margin: 0;
        font-size: 18px;
        flex: 1;
    }

    .memo p {
        margin: 0;
        font-size: 14px;
        color: #9B9B9B;
        /* 内容が長くても1行で表示（テキストがあふれた場合は省略） */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* 右側のアイコンボタン用 */
    .memo-actions {
        display: flex;
        gap: 10px;
        margin-left: 10px;
    }

    .icon-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        color: #9B9B9B;
        padding: 5px;
    }

    .icon-btn:hover {
        color: #555;
    }

    .message {
        padding: 15px 20px;
        background-color: #e9f8fd;
        /* 優しい青系の背景 */
        border-left: 5px solid #007BFF;
        /* 左側にアクセントをつける */
        border-radius: 4px;
        color: #333;
        font-size: 16px;
        margin: 15px 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* モーダル全体のオーバーレイ */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        /* 非表示状態 */
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    /* モーダルのコンテンツ */
    .modal-content {
        background: #fdfbf8;
        padding: 20px;
        border-radius: 8px;
        max-width: 500px;
        width: 80%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    /* クローズボタン */
    .modal-close {
        float: right;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
    }
</style>

<!-- Font Awesome CDN を読み込み -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.min.js"></script>

<!-- 作成用モーダル -->
<!-- 背景クリック時にモーダルを閉じようとしたけど中身のフォームが反応しなくなる -->
<!-- <div class="modal-overlay" data-bind="style: { display: showNewMemoModal() ? 'flex' : 'none' }, click: function(data, event) { if(event.target === event.currentTarget) showNewMemoModal(false); }"> -->
<div class="modal-overlay" data-bind="style: { display: showNewMemoModal() ? 'flex' : 'none' }">
    <div class="modal-content">
        <span class="modal-close" data-bind="click: function() { showNewMemoModal(false); }">&times;</span>
        <h2>新規メモ作成</h2>
        <div class="spinner-overlay" data-bind="visible: isLoading">
            <div class="spinner" data-bind="visible: isLoading"></div>
        </div>
        <form data-bind="submit: createMemo">
            <input class="w-full" type="text" name="memo_title" placeholder="メモのタイトルを入力" data-bind="value: newMemoTitle" required />
            <button class="btn-accent w-full" type="submit">作成する</button>
        </form>
    </div>
</div>

<!-- 編集用モーダル -->
<div class="modal-overlay" data-bind="style: { display: showEditMemoModal() ? 'flex' : 'none' }">
    <div class="modal-content">
        <span class="modal-close" data-bind="click: function() { showEditMemoModal(false); }">&times;</span>
        <h2>メモ編集</h2>
        <div class="spinner-overlay" data-bind="visible: isLoading">
            <div class="spinner" data-bind="visible: isLoading"></div>
        </div>
        <form data-bind="submit: updateMemo">
            <input class="w-full" type="text" name="memo_title" placeholder="メモのタイトルを入力" data-bind="value: editMemoTitle" required />
            <button class="btn-accent w-full" type="submit">更新する</button>
        </form>
    </div>
</div>

<div>
    <div class="spinner-overlay" data-bind="visible: isLoading">
        <div class="spinner" data-bind="visible: isLoading"></div>
    </div>
    <h1 class="welcome"><?php echo $username; ?>さん､ようこそ</h1>
    <div>
        <?php if ($message = \Fuel\Core\Session::get_flash('message')): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
    <!-- ヘッダー：左側に「メモ一覧」、右側に新規作成ボタン -->
    <div class="content-header">
        <span class="content-title">メモ一覧</span>
        <button class="btn-primary header-btn" data-bind="click: openNewMemoModal">新規メモ作成</button>
    </div>

    <!-- メモ一覧 -->
    <div class="memos" data-bind="foreach: memos">
        <a class="memo" data-bind="attr: { href: '/edit/' + memo_id }">
            <div class="memo-info">
                <h3 data-bind="text: title"></h3>
                <p>最終更新: <span data-bind="text: updated_at"></span></p>
            </div>
            <div class="memo-actions">
                <button class="icon-btn view-btn" data-bind="click: function(data, event) { 
                    event.stopPropagation(); window.open('/view/' + memo_id, '_blank'); }">
                    <i class="fa fa-eye"></i>
                </button>
                <button class="icon-btn edit-btn" data-bind="click: $parent.editMemo">
                    <i class="fa fa-edit"></i>
                </button>
                <button class="icon-btn delete-btn" data-bind="click: $parent.deleteMemo">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </a>
    </div>
    <script src="/assets/js/home.js"></script>
</div>