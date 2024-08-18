# LSTM 모델 기반 태양광 발전량 예측 솔루션 (팀명 : 스물여섯,스물일곱) 
<br/>
 <img width="350" alt="NPSS_logo3" src="https://github.com/user-attachments/assets/8b42d8ca-b67c-4335-9205-ed21efcf037a"/>
<br/>
<br/>
 

## 📌프로젝트 소개
#### · LSTM 모델을 활용해서 미세먼지 농도 시계열 데이터와 발전량 데이터를 분석, 예측하는 모델 제작<br/>
#### · 기상인자와 대기 상태 물질(6종)을 기반으로 미세먼지 농도를 예측하여 상관관계를 분석하고 발전소 환경에 따른 발전량의 인과관계를 도출<br/>
#### · Flutter를 사용한 태양광 발전량 예측 App 제작<br/>
#### · 현재 발전량 및 예측 발전량, 전기 시장의 REC, SMP와 더불어 기상정보를 App으로 확인 가능<br/>
#### · Ubuntu 22.04(Linux) 안에 HTML, CSS, JS, PHP를 사용하여 관리페이지 제작<br/>
#### · IoT 센서로 데이터를 수집하고, 모델에 데이터를 적용하여 정확도 향상<br/>
<br/>

## 📌프로젝트 기간
#### 2024.07.11 ~ 2024.08.22 (7주)
<br/>

## 📌프로젝트 주요 기술
#### · 버전관리 및 협업툴 (git, github, Figma)<br/>
#### · App 제작 (Android Studio)<br/>
#### · Web 제작 (HTML, CSS, JS, PHP)<br/>
#### · 센서 데이터 수집 (Arduino)<br/>
#### · DB 연결 및 서버구축(Oracle, Linux, Apache, Node.js)<br/>
#### · 딥러닝 알고리즘 (Python keras)<br/>
<br/>

## 📌기술스택
<table>
    <tr>
        <th>구분</th>
        <th>내용</th>
    </tr>
    <tr>
        <td>사용언어</td>
        <td>
          <img src="https://img.shields.io/badge/Python-3776AB?style=for-the-badge&logo=Python&logoColor=white"/>
          <img src="https://img.shields.io/badge/C++-00599C?style=for-the-badge&logo=C++&logoColor=white"/> 
          <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=JavaScript&logoColor=white"/>
          <img src="https://img.shields.io/badge/React-61DAFB?style=for-the-badge&logo=React&logoColor=black">
          <img src="https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=Node.js&logoColor=white"/>
        </td>
    </tr>
    <tr>
        <td>라이브러리</td>
        <td>
          <img src="https://img.shields.io/badge/AWS-%23FF9900.svg?style=for-the-badge&logo=amazon-aws&logoColor=white" > 
            <img src="https://img.shields.io/badge/BootStrap-7952B3?style=for-the-badge&logo=BootStrap&logoColor=white"/>
          <img src="https://img.shields.io/badge/React_Router-CA4245?style=for-the-badge&logo=react-router&logoColor=white">
<img src="https://img.shields.io/badge/Axios-007CE2?style=for-the-badge&logo=axios&logoColor=white" >
        </td>
    </tr>
    <tr>
        <td>개발도구</td>
        <td>
            <img src="https://img.shields.io/badge/RaspberryPi-A22846?style=for-the-badge&logo=RaskpberryPi&logoColor=white"/>
            <img src="https://img.shields.io/badge/Arduino-00979D?style=for-the-badge&logo=Arduino&logoColor=white"/>
            <img src="https://img.shields.io/badge/VSCode-007ACC?style=for-the-badge&logo=VisualStudioCode&logoColor=white"/>
        </td>
    </tr>
    <tr>
        <td>데이터베이스</td>
        <td>
            <img src="https://img.shields.io/badge/Oracle 11g-F80000?style=for-the-badge&logo=Oracle&logoColor=white"/>
        </td>
    </tr>
    <tr>
        <td>협업도구</td>
        <td>
            <img src="https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=Git&logoColor=white"/>
            <img src="https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=GitHub&logoColor=white"/>
        </td>
    </tr>
</table>
<br/>


## 📌시스템 아키텍처
<img width="630" alt="시스템아키텍처2" src="https://github.com/user-attachments/assets/d271ff70-8371-4ab1-903d-19fb21492bdb">
<br/>

## 📌유스케이스
![유스케이스](https://github.com/user-attachments/assets/db7289bd-a8a0-48dd-909c-b60b5d3b2aed)
<br/>

## 📌ER 다이어그램
![erd](https://github.com/user-attachments/assets/d3196960-95ed-47de-9c45-4b0258bf7177)
<br/>

## 📌화면구성
#### <APP>
##### 1. 로그인/회원가입 화면<br/>
![조명페이지](https://github.com/2024-SMHRD-IS-IOT-3/NPSS/assets/165890322/8c5ee8c7-2fbf-4eb6-96e0-8ede15e9655e)
##### 2. 공지사항 화면<br/>
![태양광페이지](https://github.com/2024-SMHRD-IS-IOT-3/NPSS/assets/165890322/bcfebaa1-cb49-4e49-97cf-7698ff9e169e)
##### 3. 발전량 예측 화면<br/>
![냉난방페이지](https://github.com/2024-SMHRD-IS-IOT-3/NPSS/assets/165890322/b87e962f-d80e-4181-9590-86238e6e2d31)
##### 4. 메인 화면<br/>
##### 5. 모집 게시판 화면<br/>
##### 6. 마이페이지 화면<br/>
<br/>
#### <WEB (관리자 페이지)>
##### 1. 공지사항 등록 페이지<br/>
##### 2. 회원 관리 페이지<br/>
##### 3. 모집 게시판 관리 페이지<br/>
<br/>

## 📌팀원역할
<table>
  <tr>
    <td align="center"><strong>김희원</strong></td>
    <td align="center"><strong>홍지연</strong></td>
    <td align="center"><strong>최수빈</strong></td>
    <td align="center"><strong>김준</strong></td>
    <td align="center"><strong>박태하</strong></td>
  </tr>
 <tr>
    <td align="center">팀장, PM, Back-End</td>
    <td align="center">Front-End, 하드웨어</td>
    <td align="center">Front-End, Back-End</td>
    <td align="center">Back-End, 하드웨어</td>
    <td align="center">Front-End</td>
  </tr>
 <tr>
    <td>· 리스크관리(기술적 문제, 팀워크 문제)<br/>· 프로젝트 일정/개인별 진행사항 파악, 회의 진행 및 회의록 작성<br/>· 모델 제작, 모델 학습<br/>· DB 설계 및 구축<br/>· APP-Server-DB 연동<br/>· WEB(관리자용) 제작</td>
    <td>· APP 로고 디자인<br/>· APP - 로그인/회원가입/발전소등록 페이지<br/>· 프로토타입(시제품) 제작<br/>· PPT 제작<br/>· 시연 영상 제작</td>
    <td>· APP 디자인<br/>· APP - 공지사항/발전량 예측/메인/모집게시판/마이페이지 제작<br/>· APP-Server-DB 연동</td>
    <td>· DB 통신<br/>· IoT 하드웨어<br/>· 프로토타입(시제품) 제작<br/>· DB 연계</td>
    <td>· WEB(관리자용) 로그인 페이지 제작</td>
  </tr>
  <tr>
    <td align="center"><a href="https://github.com/Heewoooon" target='_blank'>github</a></td>
    <td align="center"><a href="https://github.com/ongji" target='_blank'>github</a></td>
    <td align="center"><a href="https://github.com/soob0513" target='_blank'>github</a></td>
    <td align="center"><a href="https://github.com/kinick1" target='_blank'>github</a></td>
    <td align="center"><a href="https://github.com/SAMTAEGUEK" target='_blank'>github</a></td>
  </tr>
</table>
<br/>

## 📌참고문헌
- (기사) 국내 최초 전통조명 대비 스마트조명 정확한 에너지절감률 측정<br/>
https://www.electimes.com/news/articleView.html?idxno=317527<br/>
- SK쉴더스 공식 홈페이지<br/>
 https://www.skshieldus.com/kor/index.do 
gcl_keyword=kt%20%ED%85%94%EB%A0%88%EC%BA%85&gcl_network=g&gad_source=1&gclid=Cj0KCQjw0ruyBhDuARIsANSZ3wogZyIgr2LeOAeo34gzFrobsFe8mFpbTMeKw2cDfdrj0NUz2HlaKEoaAhIiEALw_wcB<br/>
- (기사) 전기료 인상에…24시 무인 점포 패닉 “폐업 해야 되나”<br/>
 https://biz.chosun.com/topics/topics_social/2023/05/18/B3X3I67IWVBYVH5HFGYEKKHOKI/<br/>
- (기사) [그래픽] 전기요금 인상폭 추이<br/>
 https://www.yna.co.kr/view/GYH20230621000800044<br/>
- (기사) 최저임금 인상에 편의점 '무인점포' 각광받는데···아직은 시기상조?<br/>
 https://www.sisajournal-e.com/news/articleView.html?idxno=301739<br/>
- (기사) 서울시, 무인 점포 아이스크림 판매점 쓰레기, 악취 , 위생 불량 심각<br/>
https://www.journal25.com/news/articleView.html?idxno=291181<br/>
- (기사) [무인점포 가보니] '쓰레기 폭탄·소비자 불만 폭발' … 왜 증가할까 ?<br/>
https://www.safetimes.co.kr/news/articleView.html?idxno=111166<br/>


