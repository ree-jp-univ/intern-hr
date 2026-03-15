function AppViewModel() {
    var self = this;
    self.isLoading = ko.observable(false);
    self.memos = ko.observableArray([]);

    // /home/memosへGETリクエストしてメモを取得する
    self.fetchMemos = function () {
        fetch('/home/memos')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                self.memos(data);
            })
            .catch(function (error) {
                console.error('Error fetching memos:', error);
            });
    };

    self.showNewMemoModal = ko.observable(false);
    self.newMemoTitle = ko.observable("");

    // モーダルを表示する関数
    self.openNewMemoModal = function () {
        self.showNewMemoModal(true);
    };

    // フォーム送信時に API を呼び、新規メモ作成する関数
    self.createMemo = function () {
        self.isLoading(true);

        const params = new URLSearchParams();
        params.append('title', self.newMemoTitle());
        fetch('/api/memo/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: params.toString(),
        }).then(function (response) {
            if (response.ok) {
                self.fetchMemos();
                self.newMemoTitle("");
            } else {
                throw new Error("新規メモ作成に失敗しました");
            }
            self.showNewMemoModal(false);
            self.isLoading(false);
        }).catch(function (error) {
            console.error('メモ作成エラー:', error);
            alert(error.message);
            self.showNewMemoModal(false);
            self.isLoading(false);
        });
    };

    self.showEditMemoModal = ko.observable(false);
    self.selectedMemo = ko.observable(null);
    self.editMemoTitle = ko.observable("");

    // 編集ボタンをクリックしたときの処理
    self.editMemo = function (memo) {
        // 編集フォームに既存のタイトルをセット
        self.selectedMemo(memo);
        self.editMemoTitle(memo.title);
        self.showEditMemoModal(true);
    };

    self.updateMemo = function () {
        self.isLoading(true);
        const params = new URLSearchParams();
        params.append('memo_id', self.selectedMemo().memo_id);
        params.append('title', self.editMemoTitle());
        fetch('/api/memo/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: params.toString(),
        }).then(function (response) {
            if (response.ok) {
                self.fetchMemos();
                self.showEditMemoModal(false);
                self.isLoading(false);
            } else {
                throw new Error("メモ更新に失敗しました");
            }
        }).catch(function (error) {
            console.error('メモ更新エラー:', error);
            alert(error.message);
            self.isLoading(false);
        });
    };

    self.deleteMemo = function (memo) {
        if (confirm("本当に削除してよろしいですか？")) {
            self.isLoading(true);
            const params = new URLSearchParams();
            params.append('memo_id', memo.memo_id);
            fetch('/api/memo/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: params.toString(),
            }).then(function (response) {
                if (response.ok) {
                    self.fetchMemos();
                    self.isLoading(false);
                } else {
                    throw new Error("削除に失敗しました");
                }
            }).catch(function (error) {
                console.error('削除エラー:', error);
                alert(error.message);
                self.isLoading(false);
            });
        }
    };


    this.fetchMemos();
}

// Knockout.jsを適用
ko.applyBindings(new AppViewModel());