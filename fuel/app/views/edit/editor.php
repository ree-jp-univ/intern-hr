<style>
    .editor-container {
        margin: 0 auto;
        max-width: 600px;
    }

    /* ヘッダー部分 */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
        margin: 0 auto;
        max-width: 800px;
    }

    .content-title {
        flex: 5;
        font-size: 20px;
        font-weight: bold;
    }

    .header-btns {
        flex: 3;
        display: flex;
        gap: 10px;
    }
</style>

<script>
    // FuelPHPから渡されたデータを埋め込む
    window.__INITIAL_DATA__ = <?= json_encode($memo); ?>;
</script>

<div>
    <div id="editor">エディターを読み込み中...</div>
    <script src="http://localhost:9000/assets/js/react/editor.js"></script>
    <!-- <script src="/assets/js/react/editor.js"></script> -->
</div>