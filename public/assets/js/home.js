function AppViewModel() {
    this.message = ko.observable("これはKnockout.jsでバインドされたメッセージです。");
}

// Knockout.jsを適用
ko.applyBindings(new AppViewModel(), document.querySelector('.content'));