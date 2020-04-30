define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'lottery/orders/index' + location.search,
                    add_url: 'lottery/orders/add',
                    edit_url: 'lottery/orders/edit',
                    del_url: 'lottery/orders/del',
                    multi_url: 'lottery/orders/multi',
                    table: 'bet',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'did', title: __('Did')},
                        {field: 'uid', title: __('Uid')},
                        {field: 'username', title: __('Username')},
                        {field: 'csk', title: __('Csk')},
                        {field: 'type', title: __('Type')},
                        {field: 'qishu', title: __('Qishu')},
                        {field: 'wanfa', title: __('Wanfa')},
                        {field: 'zhudan', title: __('Zhudan')},
                        {field: 'odds', title: __('Odds'), operate:'BETWEEN'},
                        {field: 'money', title: __('Money')},
                        {field: 'win', title: __('Win'), operate:'BETWEEN'},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                        {field: 'result', title: __('Result')},
                        // {field: 'jkzt', title: __('Jkzt')},
                        {field: 'addtime', title: __('Addtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},

                        {field: 'fandian', title: __('Fandian'), operate:'BETWEEN'},
                        {field: 'endtime', title: __('Endtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});