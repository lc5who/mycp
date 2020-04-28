define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'lottery/lotteryk/index' + location.search,
                    add_url: 'lottery/lotteryk/add',
                    edit_url: 'lottery/lotteryk/edit',
                    del_url: 'lottery/lotteryk/del',
                    multi_url: 'lottery/lotteryk/multi',
                    table: 'opresult',
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
                        {field: 'lottery.name', title: __('Lottery.name')},
                        {field: 'qishu', title: __('Qishu')},
                        {field: 'datetime', title: __('Datetime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                        {field: 'result', title: __('Result')},
                        {field: 'len', title: __('Len')},
                        {field: 'data', title: __('Data')},
                        {field: 'jsstatus', title: __('Jsstatus'), searchList: {"0":__('Jsstatus 0'),"1":__('Jsstatus 1')}, formatter: Table.api.formatter.status},

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