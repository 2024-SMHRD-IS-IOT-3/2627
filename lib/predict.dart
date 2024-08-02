import 'package:flutter/material.dart';

import 'package:syncfusion_flutter_charts/charts.dart';
import 'package:syncfusion_flutter_charts/sparkcharts.dart';


class Predict extends StatefulWidget {
  const Predict({super.key});

  @override
  State<Predict> createState() => _PredictState();
}

class _PredictState extends State<Predict> {
  final List<ChartData> chartData = <ChartData>[
    ChartData('6', 129),
    ChartData('7', 90),
    ChartData('8', 107),
    ChartData('9', 68),
    ChartData('10', 129),
    ChartData('11', 90),
    ChartData('12', 107),
    ChartData('13', 68),
    ChartData('14', 129),
    ChartData('15', 90),
    ChartData('16', 107),
    ChartData('17', 68),
    ChartData('18', 129),
    ChartData('19', 90),
    ChartData('20', 107),
    ChartData('21', 68),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        title: Image.asset('image/solQuiz_logo1.png',width: 130,),
        backgroundColor: Colors.white,
        actions: [
          IconButton(
            icon: Icon(Icons.add_alert),
            style: ButtonStyle(
              iconColor: MaterialStateProperty.all<Color>(Colors.grey),
            ),
            onPressed: (){
              print('icon alert');
            },
          ),
          IconButton(
            icon: Icon(Icons.logout_outlined),
            style: ButtonStyle(
              iconColor: MaterialStateProperty.all<Color>(Colors.grey),
            ),
            onPressed: (){
              print('icon logout');
            },
          ),
        ],
      ),
      // appBar: AppBar(
      //   title: Text('발전량 예측', style: TextStyle(fontWeight: FontWeight.bold),),
      //   backgroundColor: Colors.white,
      // ),
      body: Center(
        child: Column(
          children: [
            Container(
              width: double.infinity,
              height: 50,
              padding: EdgeInsets.fromLTRB(12, 0, 0, 5),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text('발전량 페이지', style: TextStyle(fontSize: 25,fontWeight: FontWeight.bold,),),
                ],
              ),
            ),
            Container(
              width: double.infinity,
              margin: EdgeInsets.all(10),
              padding: EdgeInsets.all(15),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12),
                boxShadow: [
                  BoxShadow(
                    color: Colors.grey.withOpacity(0.5),
                    spreadRadius: 1.5,
                    blurRadius: 5,
                    offset: Offset(0, 3), // 그림자 위치 변경
                  ),
                ],
              ),
              child: Column(
                children: [
                  Text('2024년 8월 2일', style: TextStyle(fontSize: 15, fontWeight: FontWeight.bold),),
                  Container(
                      child: SfCartesianChart(
                          primaryXAxis: CategoryAxis(),
                          palette: <Color>[
                            Color(0xfffd9a06),
                            Colors.deepPurple,
                          ],
                          series: <CartesianSeries>[
                            // Render column series
                            ColumnSeries<ChartData, String>(
                                dataSource: chartData,
                                xValueMapper: (ChartData data, _) => data.x,
                                yValueMapper: (ChartData data, _) => data.y
                            ),
                            // Render line series
                            LineSeries<ChartData, String>(
                                dataSource: chartData,
                                xValueMapper: (ChartData data, _) => data.x,
                                yValueMapper: (ChartData data, _) => data.y
                            )
                          ]
                      )
                  )
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class ChartData {
  ChartData(this.x, this.y);
  final String x;
  final double? y;
}
