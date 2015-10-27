select
  tt.order_name `OrderName`,
  group_concat(tt.tester_name  separator ', ') `TestersName`
from
  (
    select
      t.order_id   `order_id`,
      t.order_name `order_name`,
      concat(
          group_concat(tester_name order by tester_name separator ', '),
          ' ',
          concat('(', organization_name, ')')
      ) `tester_name`
    from
      (select
         Orders.ID                                        `order_id`,
         Orders.Name                                      `order_name`,
         concat(Testers.FirstName, ' ', Testers.LastName) `tester_name`,
         Organizations.ID                                 `organization_id`,
         Organizations.Name                               `organization_name`
       from Orders
         inner join Order_Tester on Order_Tester.OrderID = Orders.ID
         inner join Testers on Order_Tester.TesterID = Testers.ID
         inner join Organizations on Testers.OrganizationID = Organizations.ID
       group by Orders.ID, Testers.ID order by null) t
    group by t.order_id, t.organization_id order by null
  ) tt
group by tt.order_id
order by null
;
