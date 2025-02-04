function AppViewModel() {
    var self = this;
    self.memos = ko.observableArray([]);

    // /home/memosへGETリクエストしてメモを取得する
    fetch('/home/memos')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            self.memos(data);   
        })
        .catch(function(error) {
            console.error('Error fetching memos:', error);
        });
}

// Knockout.jsを適用
ko.applyBindings(new AppViewModel());